<?php
namespace App\Controller;

use App\Controller\AppController;

class PessoasController extends AppController
{

    public function index()
    {
        $xPessoas = $this->Pessoas->find('all')->orderBy(['Pessoas.created' => 'DESC']);
        $pessoas = $this->paginate($xPessoas);

        $this->set(compact('pessoas'));
    }

    public function add()
    {
        $pessoa = $this->Pessoas->newEmptyEntity();
        if ($this->request->is('post')) {
            $pessoa = $this->Pessoas->patchEntity($pessoa, $this->request->getData());
            if ($this->Pessoas->save($pessoa)) {
                $this->Flash->success(__('The pessoa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pessoa could not be saved. Please, try again.'));
        }
        $this->set(compact('pessoa'));
    }
}