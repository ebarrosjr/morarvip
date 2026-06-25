<?php
namespace App\Controller;

use App\Controller\AppController;

class PessoasController extends AppController
{

    public function index()
    {
        $xPessoas = $this->ownedPropertyOwnersQuery();
        $pessoas = $this->paginate($xPessoas);

        $this->set(compact('pessoas'));
    }

    public function proprietarios()
    {
        $xPessoas = $this->ownedPropertyOwnersQuery();
        $pessoas = $this->paginate($xPessoas);

        $this->set(compact('pessoas'));
        $this->render('index');
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

    private function ownedPropertyOwnersQuery()
    {
        $userId = (int)$this->Authentication->getIdentity()->getIdentifier();
        $proprietarios = $this->fetchTable('Imoveis')
            ->find()
            ->select(['Imoveis.proprietario'])
            ->where([
                'Imoveis.user_id' => $userId,
                'Imoveis.proprietario IS NOT' => null,
            ])
            ->distinct(['Imoveis.proprietario']);

        return $this->Pessoas
            ->find()
            ->where(['Pessoas.id IN' => $proprietarios])
            ->orderBy(['Pessoas.created' => 'DESC']);
    }
}
