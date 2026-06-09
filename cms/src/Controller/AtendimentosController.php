<?php
namespace App\Controller;

use App\Controller\AppController;

class AtendimentosController extends AppController
{

    public function index()
    {
        $query = $this->fetchTable('Pessoas')->find()
            ->matching('Atendimentos')
            ->contain([
                'Atendimentos' => function ($q) {
                    return $q->orderBy(['Atendimentos.created' => 'DESC']);
                }
            ]);
        $pessoas = $this->paginate($query);
        $this->set(compact('pessoas'));
    }

    public function atender($id = null)
    {
        $tblPessoas = $this->fetchTable('Pessoas');
        if($id === null) {
            $atendimentos = $this->Atendimentos->find()
                ->select(['pessoa_id'])
                ->where(['conversao <>' => 'X']);

            $pessoa = $this->fetchTable('Pessoas')->find()
                ->where(['Pessoas.id NOT IN' => $atendimentos])
                ->orderBy(['Pessoas.created' => 'DESC'])
                ->first();
        } else {
            $pessoa = $tblPessoas->get($id);
        }

        if (!$pessoa) {
            if ($this->request->is('ajax')) {
                $this->viewBuilder()->setLayout('ajax');
                return $this->response->withStringBody(
                    '<div class="modal-header"><h5 class="modal-title">Atender pessoa</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button></div><div class="modal-body">Não há pessoas pendentes para atendimento.</div><div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button></div>'
                );
            }

            $this->Flash->info(__('Não há pessoas pendentes para atendimento.'));
            return $this->redirect(['controller' => 'Atendimentos', 'action' => 'index']);
        }
        
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        } else {
            $this->viewBuilder()->setLayout('default');
        }
        $this->set(compact('pessoa'));
    }

    public function registraAtendimento()
    {
        $data = [];

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $identity = $this->Authentication->getIdentity();
            $data['atendido_por'] = $identity ? $identity->id : null;
            $atendimento = $this->Atendimentos->newEmptyEntity();
            $atendimento = $this->Atendimentos->patchEntity($atendimento, $data);
            if ($this->Atendimentos->save($atendimento)) {
                $this->Flash->success(__('Atendimento registrado com sucesso!'));
            } else {
                $this->Flash->error(__('Não foi possível registrar o atendimento. Por favor, tente novamente.'));
            }
        }

        if (isset($data['N'])) {
            $atendimentos = $this->Atendimentos->find()
                ->select(['pessoa_id'])
                ->where(['conversao <>' => 'X']);
            $proximo = $this->fetchTable('Pessoas')->find()
                ->where(['Pessoas.id NOT IN' => $atendimentos])
                ->orderBy(['Pessoas.created' => 'DESC'])
                ->first();

            if ($proximo) {
                if ($this->request->is('ajax')) {
                    $this->viewBuilder()->setLayout('ajax');
                    $this->set('pessoa', $proximo);
                    return $this->render('atender');
                }

                return $this->redirect(['controller' => 'Atendimentos', 'action' => 'atender', $proximo->id]);
            }
        }

        if ($this->request->is('ajax')) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'redirect' => $this->request->getAttribute('webroot') . 'pessoas',
                ]));
        }

        return $this->redirect(['controller' => 'Pessoas', 'action' => 'index']);
    }
}
