<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $identity = $this->Authentication->getIdentity();
        if (!$identity) {
            return null;
        }

        $controller = (string)$this->request->getParam('controller');
        $action = (string)$this->request->getParam('action');

        if ($controller === 'Users' && in_array($action, ['confirmation', 'logout'], true)) {
            return null;
        }

        $user = $this->fetchTable('Users')->get($identity->getIdentifier());
        if (empty($user->activation_date)) {
            return $this->redirect(['controller' => 'Users', 'action' => 'confirmation']);
        }

        return null;
    }
}
