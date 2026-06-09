<?php
declare(strict_types=1);

namespace App\Controller;

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
        $this->Authentication->allowUnauthenticated(['login', 'add']);
    }

    public function index()
    {
        $query = $this->Users->find()
            ->contain(['Plans']);
        $users = $this->paginate($query);

        $this->set(compact('users'));
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
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {

                $user->activation_code = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
                $this->Users->save($user);

                $this->Authentication->setIdentity($user);

                $this->Flash->success('Usuário registrado com sucesso! Bem-vindo ao Morar.VIP. [' . $user->activation_code . ']');
                return $this->redirect(['action' => 'confirmation']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $plans = $this->Users->Plans->find('list', limit: 200)->all();
        $this->set(compact('user', 'plans'));
    }

    public function confirmation()
    {
        $this->viewBuilder()->setLayout('auth');

        if (!$this->request->is('post')) {
            return;
        }

        $identity = $this->Authentication->getIdentity();
        if (!$identity) {
            $this->Flash->error('Faça login para ativar sua conta.');

            return $this->redirect(['action' => 'login']);
        }

        $activationCode = $this->request->getData('activation_code');
        if (is_array($activationCode)) {
            $activationCode = implode('', $activationCode);
        }

        $activationCode = strtoupper((string)preg_replace('/[^A-Z0-9]/', '', (string)$activationCode));
        $user = $this->Users->get($identity->getIdentifier());

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
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $plans = $this->Users->Plans->find('list', limit: 200)->all();
        $this->set(compact('user', 'plans'));
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
    
    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['action' => 'login']);
    }
}
