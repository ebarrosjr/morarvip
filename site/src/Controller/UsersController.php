<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;
use Cake\Mailer\Mailer;
use Cake\Routing\Router;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Provider\Google;
use RuntimeException;
use Throwable;

class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->allowUnauthenticated([
            'login',
            'loginWith',
            'register',
            'forgotPassword',
            'resetPassword',
        ]);
    }

    public function index()
    {
    }

    public function dashboard()
    {
        $identity = $this->request->getAttribute('identity');
        $loggedUser = $identity && method_exists($identity, 'getOriginalData') ? $identity->getOriginalData() : $identity;
        $userId = (int)($loggedUser->id ?? 0);
        $pessoas = $this->fetchTable('Pessoas');
        $profileUser = $userId > 0 ? $pessoas->get($userId) : null;

        if ($profileUser && $this->request->is(['post', 'put', 'patch']) && $this->request->getData('_profile_form')) {
            $profileUser = $pessoas->patchEntity($profileUser, $this->request->getData(), [
                'fields' => [
                    'nome',
                    'email',
                    'cpf',
                    'nascimento',
                    'sexo',
                    'telefone',
                    'whatsapp',
                    'telegram',
                    'facebook',
                    'instagram',
                    'cep',
                    'numero',
                    'complemento',
                    'propaganda',
                    'share_data',
                ],
            ]);

            if ($pessoas->save($profileUser)) {
                $this->Authentication->setIdentity($profileUser);
                $this->Flash->success(__('Seus dados foram atualizados com sucesso.'));

                return $this->redirect(['action' => 'dashboard', '#' => 'ltn_tab_1_2']);
            }

            $this->Flash->error(__('Não foi possível atualizar seus dados. Verifique as informações e tente novamente.'));
        }

        $userProperties = [];
        if ($userId > 0) {
            $userProperties = $this->fetchTable('Imoveis')
                ->find()
                ->contain([
                    'TipoImoveis',
                    'FotoImoveis' => function ($q) {
                        return $q->orderBy([
                            'FotoImoveis.principal' => 'DESC',
                            'FotoImoveis.id' => 'ASC',
                        ]);
                    },
                ])
                ->where([
                    'OR' => [
                        'Imoveis.user_id' => $userId,
                        'Imoveis.proprietario' => $userId,
                    ],
                ])
                ->orderBy(['Imoveis.created' => 'DESC'])
                ->all()
                ->toList();
        }

        $this->set(compact('profileUser', 'userProperties'));
    }

    public function login()
    {
        $result = $this->Authentication->getResult();
        $redirect = $this->getRedirectTarget();

        // If the user is logged in send them away.
        if ($result && $result->isValid()) {
            if ($this->request->is('ajax')) {
                return $this->jsonResponse([
                    'success' => true,
                    'redirect' => $redirect,
                ]);
            }

            return $this->redirect($redirect);
        }

        if ($this->request->is('post')) {
            if ($this->request->is('ajax')) {
                return $this->jsonResponse([
                    'success' => false,
                    'message' => __('E-mail ou senha inválidos.'),
                ], 401);
            }

            $this->Flash->error(__('E-mail ou senha inválidos.'));
        }

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }

        $this->set(compact('redirect'));
    }

    public function loginWith(string $provider)
    {
        $provider = strtolower($provider);
        $redirect = $this->getRedirectTarget();

        try {
            $oauthProvider = $this->buildOAuthProvider($provider);
            $providerConfig = $this->getOAuthConfig($provider);
        } catch (NotFoundException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            $this->Flash->error(__('Login social indisponível no momento.'));

            return $this->redirect(['action' => 'login', '?' => ['redirect' => $redirect]]);
        }

        if (!$this->request->getQuery('code')) {
            $state = bin2hex(random_bytes(16));
            $session = $this->request->getSession();
            $session->write("OAuth.{$provider}.state", $state);
            $session->write("OAuth.{$provider}.redirect", $redirect);

            $options = ['state' => $state];
            $scopes = $providerConfig['scopes'] ?? [];
            if (!empty($scopes)) {
                $options['scope'] = $scopes;
            }

            return $this->redirect($oauthProvider->getAuthorizationUrl($options));
        }

        $session = $this->request->getSession();
        $expectedState = $session->read("OAuth.{$provider}.state");
        $receivedState = $this->request->getQuery('state');

        if (!$expectedState || !$receivedState || !hash_equals($expectedState, $receivedState)) {
            $session->delete("OAuth.{$provider}");
            $this->Flash->error(__('Não foi possível validar o login social.'));

            return $this->redirect(['action' => 'login', '?' => ['redirect' => $redirect]]);
        }

        $redirect = $session->read("OAuth.{$provider}.redirect") ?: $redirect;
        $session->delete("OAuth.{$provider}");

        try {
            $token = $oauthProvider->getAccessToken('authorization_code', [
                'code' => $this->request->getQuery('code'),
            ]);
            $owner = $oauthProvider->getResourceOwner($token);
            $pessoa = $this->findOrCreateSocialUser($provider, $owner->toArray());
        } catch (IdentityProviderException $exception) {
            $this->Flash->error(__('Não foi possível autenticar com {0}.', ucfirst($provider)));

            return $this->redirect(['action' => 'login', '?' => ['redirect' => $redirect]]);
        }

        if (!$pessoa) {
            $this->Flash->error(__('Não foi possível localizar os dados básicos da sua conta social.'));

            return $this->redirect(['action' => 'login', '?' => ['redirect' => $redirect]]);
        }

        $this->Authentication->setIdentity($pessoa);

        return $this->redirect($redirect);
    }

    public function register()
    {
        $redirect = $this->getRedirectTarget();
        $pessoas = $this->fetchTable('Pessoas');
        $pessoa = $pessoas->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $message = $this->validateRegisterData($data);

            if ($message === null && $pessoas->exists(['email' => $data['email']])) {
                $message = __('Este e-mail já está cadastrado.');
            }

            if ($message === null) {
                $data['whatsapp'] = $data['telefone'];
                $data['origem'] = 'S';
                $pessoa = $pessoas->newEntity($data, [
                    'fields' => ['nome', 'email', 'telefone', 'whatsapp', 'password', 'origem'],
                ]);

                if ($pessoas->save($pessoa)) {
                    $this->Authentication->setIdentity($pessoa);

                    if ($this->request->is('ajax')) {
                        return $this->jsonResponse([
                            'success' => true,
                            'redirect' => $redirect,
                        ]);
                    }

                    return $this->redirect($redirect);
                }

                $message = __('Não foi possível concluir o cadastro. Verifique os dados informados.');
            }

            if ($this->request->is('ajax')) {
                return $this->jsonResponse([
                    'success' => false,
                    'message' => $message,
                ], 422);
            }

            $this->Flash->error($message);
        }

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }

        $this->set(compact('pessoa', 'redirect'));
    }

    public function forgotPassword()
    {
        $redirect = $this->getRedirectTarget();
        $message = __('Informe seu e-mail para receber as instruções de recuperação.');
        $resetUrl = null;

        if ($this->request->is('post')) {
            $email = trim((string)$this->request->getData('email'));

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = __('Informe um e-mail válido.');

                if ($this->request->is('ajax')) {
                    return $this->jsonResponse([
                        'success' => false,
                        'message' => $message,
                    ], 422);
                }

                $this->Flash->error($message);
            } else {
                $pessoas = $this->fetchTable('Pessoas');
                $pessoa = $pessoas->find()
                    ->where(['email' => $email])
                    ->first();

                if ($pessoa) {
                    $pessoa = $pessoas->patchEntity($pessoa, [
                        'password_reset_token' => bin2hex(random_bytes(32)),
                    ], [
                        'fields' => ['password_reset_token'],
                    ]);
                    $pessoas->save($pessoa);

                    $resetUrl = Router::url([
                        'controller' => 'Users',
                        'action' => 'resetPassword',
                        $pessoa->password_reset_token,
                        '?' => ['redirect' => $redirect],
                    ], true);

                    $this->sendPasswordResetEmail($pessoa, $resetUrl);
                }

                $message = __('Se o e-mail estiver cadastrado, enviaremos as instruções de recuperação.');

                if ($this->request->is('ajax')) {
                    $payload = [
                        'success' => true,
                        'message' => $message,
                    ];

                    if (Configure::read('debug') && $resetUrl) {
                        $payload['resetUrl'] = $resetUrl;
                        $payload['message'] .= ' Link de desenvolvimento: ' . $resetUrl;
                    }

                    return $this->jsonResponse($payload);
                }

                $this->Flash->success($message);

                return $this->redirect(['action' => 'login', '?' => ['redirect' => $redirect]]);
            }
        }

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }

        $this->set(compact('redirect', 'message'));
    }

    public function resetPassword(?string $token = null)
    {
        $redirect = $this->getRedirectTarget();

        if (!$token) {
            throw new NotFoundException(__('Token de recuperação não informado.'));
        }

        $pessoas = $this->fetchTable('Pessoas');
        $pessoa = $pessoas->find()
            ->where(['password_reset_token' => $token])
            ->first();

        if (!$pessoa) {
            throw new NotFoundException(__('Token de recuperação inválido ou já utilizado.'));
        }

        if ($this->request->is(['post', 'put', 'patch'])) {
            $password = (string)$this->request->getData('password');
            $passwordConfirm = (string)$this->request->getData('password_confirm');
            $message = $this->validatePasswordResetData($password, $passwordConfirm);

            if ($message === null) {
                $pessoa = $pessoas->patchEntity($pessoa, [
                    'password' => $password,
                    'password_reset_token' => null,
                    'email_verified' => true,
                ], [
                    'fields' => ['password', 'password_reset_token', 'email_verified'],
                ]);

                if ($pessoas->save($pessoa)) {
                    if ($this->request->is('ajax')) {
                        return $this->jsonResponse([
                            'success' => true,
                            'redirect' => Router::url(['action' => 'login', '?' => ['redirect' => $redirect]]),
                        ]);
                    }

                    $this->Flash->success(__('Senha alterada com sucesso. Entre com sua nova senha.'));

                    return $this->redirect(['action' => 'login', '?' => ['redirect' => $redirect]]);
                }

                $message = __('Não foi possível alterar a senha.');
            }

            if ($this->request->is('ajax')) {
                return $this->jsonResponse([
                    'success' => false,
                    'message' => $message,
                ], 422);
            }

            $this->Flash->error($message);
        }

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }

        $this->set(compact('pessoa', 'token', 'redirect'));
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Index', 'action' => 'index']);
    }

    private function getRedirectTarget(): string
    {
        return $this->request->getQuery('redirect')
            ?: $this->Authentication->getLoginRedirect()
            ?: $this->referer(['controller' => 'Index', 'action' => 'index'], true);
    }

    private function validateRegisterData(array $data): ?string
    {
        $nome = trim((string)($data['nome'] ?? ''));
        $email = trim((string)($data['email'] ?? ''));
        $telefone = trim((string)($data['telefone'] ?? ''));
        $password = (string)($data['password'] ?? '');
        $passwordConfirm = (string)($data['password_confirm'] ?? '');

        if ($nome === '') {
            return __('Informe seu nome.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return __('Informe um e-mail válido.');
        }

        if ($telefone === '') {
            return __('Informe seu telefone/WhatsApp.');
        }

        if (mb_strlen($password) < 6) {
            return __('A senha deve ter pelo menos 6 caracteres.');
        }

        if ($password !== $passwordConfirm) {
            return __('A confirmação da senha não confere.');
        }

        return null;
    }

    private function validatePasswordResetData(string $password, string $passwordConfirm): ?string
    {
        if (mb_strlen($password) < 6) {
            return __('A senha deve ter pelo menos 6 caracteres.');
        }

        if ($password !== $passwordConfirm) {
            return __('A confirmação da senha não confere.');
        }

        return null;
    }

    private function buildOAuthProvider(string $provider)
    {
        $config = $this->getOAuthConfig($provider);

        if (!$config) {
            throw new NotFoundException(__('Provider OAuth não configurado.'));
        }

        if (empty($config['client_id']) || empty($config['client_secret']) || empty($config['redirect_uri'])) {
            throw new RuntimeException("OAuth provider {$provider} is missing credentials.");
        }

        if ($provider === 'google') {
            return new Google([
                'clientId' => $config['client_id'],
                'clientSecret' => $config['client_secret'],
                'redirectUri' => $config['redirect_uri'],
            ]);
        }

        if ($provider === 'facebook') {
            return new GenericProvider([
                'clientId' => $config['client_id'],
                'clientSecret' => $config['client_secret'],
                'redirectUri' => $config['redirect_uri'],
                'urlAuthorize' => 'https://www.facebook.com/v19.0/dialog/oauth',
                'urlAccessToken' => 'https://graph.facebook.com/v19.0/oauth/access_token',
                'urlResourceOwnerDetails' => 'https://graph.facebook.com/me?fields=id,name,email,picture.type(large)',
            ]);
        }

        throw new NotFoundException(__('Provider OAuth não suportado.'));
    }

    private function getOAuthConfig(string $provider): array
    {
        Configure::load('auth', 'default', false);

        return Configure::read("Auth.{$provider}") ?: Configure::read($provider) ?: [];
    }

    private function findOrCreateSocialUser(string $provider, array $ownerData)
    {
        $socialId = (string)($ownerData['id'] ?? $ownerData['sub'] ?? '');
        $email = trim((string)($ownerData['email'] ?? ''));
        $name = trim((string)($ownerData['name'] ?? $ownerData['given_name'] ?? ''));
        $photo = $this->extractSocialPhoto($ownerData);
        $emailVerified = (bool)($ownerData['email_verified'] ?? true);

        if ($socialId === '' || $email === '') {
            return null;
        }

        $socialField = $provider === 'google' ? 'google_id' : 'facebook_id';
        $pessoas = $this->fetchTable('Pessoas');
        $pessoa = $pessoas->find()
            ->where([$socialField => $socialId])
            ->first();

        if (!$pessoa) {
            $pessoa = $pessoas->find()
                ->where(['email' => $email])
                ->first();
        }

        $data = [
            'nome' => $name ?: $email,
            'email' => $email,
            $socialField => $socialId,
            'email_verified' => $emailVerified,
            'origem' => 'S',
        ];

        if ($photo !== '') {
            $data['foto'] = $photo;
        }

        if ($pessoa) {
            $pessoa = $pessoas->patchEntity($pessoa, $data, [
                'fields' => ['nome', 'email', $socialField, 'email_verified', 'origem', 'foto'],
            ]);
        } else {
            $pessoa = $pessoas->newEntity($data, [
                'fields' => ['nome', 'email', $socialField, 'email_verified', 'origem', 'foto'],
            ]);
        }

        return $pessoas->save($pessoa) ?: null;
    }

    private function extractSocialPhoto(array $ownerData): string
    {
        if (!empty($ownerData['picture']) && is_string($ownerData['picture'])) {
            return $ownerData['picture'];
        }

        if (!empty($ownerData['avatar_url']) && is_string($ownerData['avatar_url'])) {
            return $ownerData['avatar_url'];
        }

        if (!empty($ownerData['picture']['data']['url']) && is_string($ownerData['picture']['data']['url'])) {
            return $ownerData['picture']['data']['url'];
        }

        return '';
    }

    private function sendPasswordResetEmail($pessoa, string $resetUrl): void
    {
        try {
            $mailer = new Mailer('default');
            $mailer
                ->setTo($pessoa->email)
                ->setSubject(__('Recuperação de senha - Morar.Vip'))
                ->setEmailFormat('text')
                ->deliver(
                    "Olá {$pessoa->nome},\n\n" .
                    "Acesse o link abaixo para cadastrar uma nova senha:\n{$resetUrl}\n\n" .
                    "Se você não solicitou esta recuperação, ignore esta mensagem."
                );
        } catch (Throwable $exception) {
            $this->log($exception->getMessage(), 'error');
        }
    }

    private function jsonResponse(array $payload, int $status = 200)
    {
        return $this->response
            ->withType('application/json')
            ->withStatus($status)
            ->withStringBody((string)json_encode($payload));
    }
}
