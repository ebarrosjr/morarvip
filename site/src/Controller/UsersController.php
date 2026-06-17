<?php
namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->allowUnauthenticated(['login', 'register', 'forgotPassword']);
    }

    public function index()
    {
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
                $message = __('Se o e-mail estiver cadastrado, enviaremos as instruções de recuperação.');

                if ($this->request->is('ajax')) {
                    return $this->jsonResponse([
                        'success' => true,
                        'message' => $message,
                    ]);
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

    private function jsonResponse(array $payload, int $status = 200)
    {
        return $this->response
            ->withType('application/json')
            ->withStatus($status)
            ->withStringBody((string)json_encode($payload));
    }
}
