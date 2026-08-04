<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\SmsService;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->allowUnauthenticated(['login', 'add', 'esqueci', 'novaSenha']);
    }

    public function index()
    {
        $userId = (int)$this->Authentication->getIdentity()->getIdentifier();
        $partnerIds = $this->partnerUserIds($userId);
        $visibleUserIds = array_values(array_unique(array_merge([$userId], $partnerIds)));

        $query = $this->Users->find()
            ->where(['Users.id IN' => $visibleUserIds])
            ->contain(['Plans']);
        $users = $this->paginate($query);

        $this->set(compact('users', 'userId', 'partnerIds'));
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: ['Plans', 'Imoveis']);
        $this->set(compact('user'));
    }

    public function parceiros()
    {
        $parcerias = $this->fetchTable('ImovelParcerias')
            ->find()
            ->where([
                'ImovelParcerias.user_id' => $this->Authentication->getIdentity()->getIdentifier(),
            ])
            ->contain([
                'Parceiros',
                'Imoveis',
            ]);
        
        $this->set(compact('parcerias'));
    }

    public function add()
    {
        $this->viewBuilder()->setLayout('auth');
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->normalizeBrokerData($this->request->getData()));
            if ($this->Users->save($user)) {

                $user->activation_code = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
                $this->Users->save($user);
                $this->sendActivationCode($user);

                $this->Authentication->setIdentity($user);

                $this->Flash->success('Usuário registrado com sucesso. Enviamos o código de ativação por SMS.');
                return $this->redirect(['action' => 'confirmation']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $plans = $this->Users->Plans->find('list', limit: 200)->all();
        $ufs = $this->brazilianStates();
        $this->set(compact('user', 'plans', 'ufs'));
    }

    public function confirmation()
    {
        $this->viewBuilder()->setLayout('auth');

        $identity = $this->Authentication->getIdentity();
        if (!$identity) {
            $this->Flash->error('Faça login para ativar sua conta.');

            return $this->redirect(['action' => 'login']);
        }

        $user = $this->Users->get($identity->getIdentifier());
        if (!empty($user->activation_date)) {
            return $this->redirect(['controller' => 'Index', 'action' => 'index']);
        }

        if (!$this->request->is('post')) {
            return;
        }

        if ($this->request->getData('resend_activation_code')) {
            $user = $this->ensureActivationCode($user);

            if ($this->Users->save($user) && $this->sendActivationCode($user)) {
                $this->Authentication->setIdentity($user);
                $this->Flash->success('Reenviamos o código de ativação por SMS.');
            } else {
                $this->Flash->error('Não foi possível reenviar o código por SMS. Verifique o telefone cadastrado.');
            }

            return $this->redirect(['action' => 'confirmation']);
        }

        $activationCode = $this->request->getData('activation_code');
        if (is_array($activationCode)) {
            $activationCode = implode('', $activationCode);
        }

        $activationCode = strtoupper((string)preg_replace('/[^A-Z0-9]/', '', (string)$activationCode));

        if ($activationCode !== $user->activation_code) {
            $this->Flash->error('Código de ativação inválido.');

            return;
        }

        $user->activation_date = \Cake\I18n\DateTime::now();
        $user->activation_code = null;

        if (!$this->Users->save($user)) {
            $this->Flash->error('Não foi possível ativar sua conta. Tente novamente.');

            return;
        }

        $this->Authentication->setIdentity($user);
        $this->Flash->success('Conta ativada com sucesso!');

        return $this->redirect(['controller' => 'Index', 'action' => 'index']);
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->normalizeBrokerData($this->request->getData()));
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $plans = $this->Users->Plans->find('list', limit: 200)->all();
        $ufs = $this->brazilianStates();
        $this->set(compact('user', 'plans', 'ufs'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('auth');
        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result && $result->isValid()) {
            $identity = $this->Authentication->getIdentity();
            $user = $this->Users->get($identity->getIdentifier());

            if (empty($user->activation_date)) {
                $this->Authentication->setIdentity($user);

                return $this->redirect(['action' => 'confirmation']);
            }

            $target = $this->Authentication->getLoginRedirect() ?? [
                'controller' => 'Index',
                'action' => 'index',
            ];
            return $this->redirect($target);
        }
        if ($this->request->is('post')) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function esqueci()
    {
        $this->viewBuilder()->setLayout('auth');

        if (!$this->request->is(['post', 'put', 'patch'])) {
            return;
        }

        $email = trim((string)$this->request->getData('email'));
        if ($email === '') {
            $this->Flash->error('Informe o e-mail cadastrado.');

            return;
        }

        $user = $this->Users->find()
            ->where(['Users.email' => $email])
            ->first();

        if (!$user) {
            $this->Flash->error('Usuário não encontrado para o e-mail informado.');

            return $this->redirect(['action' => 'login']);
        }

        $phone = (string)($user->whatsapp ?: $user->telefone);
        if (trim($phone) === '') {
            $this->Flash->error('Este cadastro não possui telefone para envio do SMS.');

            return $this->redirect(['action' => 'login']);
        }

        $token = bin2hex(random_bytes(32));
        $user = $this->Users->patchEntity($user, ['password_reset_token' => $token], [
            'fields' => ['password_reset_token'],
        ]);

        if (!$this->Users->save($user)) {
            $this->Flash->error('Não foi possível gerar o token de recuperação. Tente novamente.');

            return $this->redirect(['action' => 'login']);
        }

        $link = Router::url(['controller' => 'Users', 'action' => 'novaSenha', $token], true);
        $firstName = $this->firstName((string)$user->nome, 'corretor');
        $message = "Ola, {$firstName}. Altere sua senha Morar.VIP em: {$link}";
        if (strlen($message) > 160) {
            $message = "Altere sua senha Morar.VIP em: {$link}";
        }

        if ((new SmsService())->sendText($phone, $message)) {
            $this->Flash->success('Enviamos um SMS com o link para criar uma nova senha.');
        } else {
            $this->Flash->error('Não conseguimos enviar o SMS. Tente novamente.');
        }

        return $this->redirect(['action' => 'login']);
    }

    public function novaSenha($token = null)
    {
        $this->viewBuilder()->setLayout('auth');
        $token = trim((string)$token);

        if ($token === '') {
            $this->Flash->error('Token de recuperação não informado.');

            return $this->redirect(['action' => 'login']);
        }

        $user = $this->Users->find()
            ->where(['Users.password_reset_token' => $token])
            ->first();

        if (!$user) {
            $this->Flash->error('Token de recuperação inválido ou já utilizado.');

            return $this->redirect(['action' => 'login']);
        }

        if (!$this->isPasswordResetTokenValid($user)) {
            $user->password_reset_token = null;
            $this->Users->save($user, ['checkRules' => false]);
            $this->Flash->error('O token está vencido. Solicite uma nova recuperação de senha.');

            return $this->redirect(['action' => 'login']);
        }

        if ($this->request->is('post')) {
            $password = (string)$this->request->getData('password');
            $confirmPassword = (string)$this->request->getData('confirm_password');

            if ($password === '' || $password !== $confirmPassword) {
                $this->Flash->error('As senhas informadas não são iguais.');

                return;
            }

            $user = $this->Users->patchEntity($user, [
                'password' => $password,
                'password_reset_token' => null,
            ], [
                'fields' => ['password', 'password_reset_token'],
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success('Senha alterada com sucesso. Faça login com a nova senha.');

                return $this->redirect(['action' => 'login']);
            }

            $this->Flash->error('Não foi possível alterar a senha. Tente novamente.');
        }

        $this->set(compact('token', 'user'));
    }
    
    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['action' => 'login']);
    }

    private function partnerUserIds(int $userId): array
    {
        $parcerias = $this->fetchTable('ImovelParcerias')
            ->find()
            ->select(['ImovelParcerias.user_id', 'ImovelParcerias.parceiro_id'])
            ->where([
                'ImovelParcerias.deleted IS' => null,
                'OR' => [
                    'ImovelParcerias.user_id' => $userId,
                    'ImovelParcerias.parceiro_id' => $userId,
                ],
            ])
            ->enableHydration(false)
            ->all();

        $partnerIds = [];
        foreach ($parcerias as $parceria) {
            $ownerId = (int)$parceria['user_id'];
            $partnerId = (int)$parceria['parceiro_id'];
            $partnerIds[] = $ownerId === $userId ? $partnerId : $ownerId;
        }

        return array_values(array_unique(array_filter($partnerIds)));
    }

    private function normalizeBrokerData(array $data): array
    {
        if (isset($data['creci'])) {
            $data['creci'] = trim((string)$data['creci']);
        }

        if (isset($data['uf_creci'])) {
            $data['uf_creci'] = strtoupper(trim((string)$data['uf_creci']));
        }

        return $data;
    }

    private function sendActivationCode($user): bool
    {
        $phone = (string)($user->whatsapp ?: $user->telefone);
        if (trim($phone) === '' || empty($user->activation_code)) {
            return false;
        }

        $firstName = $this->firstName((string)$user->nome, 'corretor');
        $message = "Ola, {$firstName}. Seu codigo de ativacao Morar.VIP: {$user->activation_code}";

        return (new SmsService())->sendText($phone, $message);
    }

    private function ensureActivationCode($user)
    {
        if (empty($user->activation_code)) {
            $user->activation_code = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        }

        return $user;
    }

    private function firstName(string $name, string $fallback): string
    {
        $names = preg_split('/\s+/', trim($name)) ?: [];
        $firstName = $names[0] ?? $fallback;

        return substr($firstName, 0, 24) ?: $fallback;
    }

    private function isPasswordResetTokenValid($user): bool
    {
        if (empty($user->modified)) {
            return false;
        }

        return $user->modified->getTimestamp() >= (time() - 86400);
    }

    private function brazilianStates(): array
    {
        return [
            'AC' => 'AC',
            'AL' => 'AL',
            'AP' => 'AP',
            'AM' => 'AM',
            'BA' => 'BA',
            'CE' => 'CE',
            'DF' => 'DF',
            'ES' => 'ES',
            'GO' => 'GO',
            'MA' => 'MA',
            'MT' => 'MT',
            'MS' => 'MS',
            'MG' => 'MG',
            'PA' => 'PA',
            'PB' => 'PB',
            'PR' => 'PR',
            'PE' => 'PE',
            'PI' => 'PI',
            'RJ' => 'RJ',
            'RN' => 'RN',
            'RS' => 'RS',
            'RO' => 'RO',
            'RR' => 'RR',
            'SC' => 'SC',
            'SP' => 'SP',
            'SE' => 'SE',
            'TO' => 'TO',
        ];
    }
}
