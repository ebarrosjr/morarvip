<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Routing\Router;

class ImoveisController extends AppController
{
    public function view($id = null)
    {
        $imovei = $this->getOwnedImovel($id, ['TipoImoveis', 'Categorias', 'FotoImoveis', 'Pessoas']);
        $this->set(compact('imovei'));
    }

    public function add()
    {
        $identity = $this->currentPessoa();
        $imovei = $this->Imoveis->newEmptyEntity();
        $imovei->pessoa = $identity;

        if ($this->request->is('post')) {
            $data = $this->preparePropertyData($this->request->getData(), $identity);
            $imovei = $this->Imoveis->patchEntity($imovei, $data, [
                'fields' => $this->propertyFields(),
            ]);

            if ($this->Imoveis->save($imovei)) {
                $this->updatePessoaFromRequest($identity, $this->request->getData('pessoa') ?? []);

                return $this->successResponse(__('Imóvel enviado com sucesso.'), ['controller' => 'Users', 'action' => 'dashboard', '#' => 'ltn_tab_1_5']);
            }

            $response = $this->errorResponse(__('Não foi possível enviar o imóvel. Verifique os dados informados.'));
            if ($response) {
                return $response;
            }
        }

        $this->loadFormLists();
        $this->set(compact('imovei'));

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }
    }

    public function edit($id = null)
    {
        $identity = $this->currentPessoa();
        $imovei = $this->getOwnedImovel($id, ['Pessoas']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->preparePropertyData($this->request->getData(), $identity);
            $imovei = $this->Imoveis->patchEntity($imovei, $data, [
                'fields' => $this->propertyFields(),
            ]);

            if ($this->Imoveis->save($imovei)) {
                $this->updatePessoaFromRequest($identity, $this->request->getData('pessoa') ?? []);

                return $this->successResponse(__('Imóvel atualizado com sucesso.'), ['controller' => 'Users', 'action' => 'dashboard', '#' => 'ltn_tab_1_5']);
            }

            $response = $this->errorResponse(__('Não foi possível atualizar o imóvel. Verifique os dados informados.'));
            if ($response) {
                return $response;
            }
        }

        $imovei->pessoa = $identity;
        $this->loadFormLists();
        $this->set(compact('imovei'));

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $imovei = $this->getOwnedImovel($id);
        if ($this->Imoveis->delete($imovei)) {
            $this->Flash->success(__('Imóvel removido com sucesso.'));
        } else {
            $this->Flash->error(__('Não foi possível remover o imóvel.'));
        }

        return $this->redirect(['controller' => 'Users', 'action' => 'dashboard', '#' => 'ltn_tab_1_5']);
    }

    private function currentPessoa()
    {
        $identity = $this->request->getAttribute('identity');

        return $identity && method_exists($identity, 'getOriginalData') ? $identity->getOriginalData() : $identity;
    }

    private function getOwnedImovel($id, array $contain = [])
    {
        $userId = (int)($this->currentPessoa()->id ?? 0);

        if ($userId <= 0) {
            throw new RecordNotFoundException(__('Imóvel não encontrado.'));
        }

        return $this->Imoveis
            ->find()
            ->where([
                'Imoveis.id' => $id,
                'OR' => [
                    'Imoveis.user_id' => $userId,
                    'Imoveis.proprietario' => $userId,
                ],
            ])
            ->contain($contain)
            ->firstOrFail();
    }

    private function preparePropertyData(array $data, $identity): array
    {
        $userId = (int)($identity->id ?? 0);

        $data['user_id'] = $userId;
        $data['proprietario'] = $userId;
        $data['show_site'] = 0;
        $data['show_preco_site'] = 0;
        $data['comissao'] = null;
        $data['comissao_permanente'] = 0;
        $data['corretor_opcionista'] = 0;
        $data['exclusividade'] = 0;
        $data['inicio_exclusividade'] = null;
        $data['fim_exclusividade'] = null;
        $data['parceiria'] = 0;
        $data['porcentagem_parceiro'] = null;

        return $data;
    }

    private function propertyFields(): array
    {
        return [
            'user_id',
            'proprietario',
            'tipo_imovel_id',
            'titulo',
            'chamada',
            'descricao',
            'categoria_id',
            'cep',
            'numero',
            'complemento',
            'tamanho',
            'quartos',
            'banheiros',
            'vaga_garagem',
            'negocio',
            'financia',
            'valor',
            'iptu',
            'show_site',
            'show_preco_site',
            'comissao',
            'comissao_permanente',
            'corretor_opcionista',
            'exclusividade',
            'inicio_exclusividade',
            'fim_exclusividade',
            'parceiria',
            'porcentagem_parceiro',
        ];
    }

    private function updatePessoaFromRequest($identity, array $pessoaData): void
    {
        $pessoas = $this->fetchTable('Pessoas');
        $pessoa = $pessoas->get((int)$identity->id);
        $pessoa = $pessoas->patchEntity($pessoa, $pessoaData, [
            'fields' => ['cpf', 'nome', 'email', 'telefone', 'whatsapp'],
        ]);

        if (!empty($pessoaData['telefone']) && empty($pessoaData['whatsapp'])) {
            $pessoa->whatsapp = $pessoaData['telefone'];
        }

        $pessoas->save($pessoa);
    }

    private function loadFormLists(): void
    {
        $categorias = $this->Imoveis->Categorias->find('list', ['limit' => 200])->all();
        $tipos = $this->Imoveis->TipoImoveis->find('list', ['limit' => 200])->all();
        $this->set(compact('categorias', 'tipos'));
    }

    private function successResponse(string $message, array $redirect)
    {
        if ($this->request->is('ajax')) {
            return $this->response
                ->withType('application/json')
                ->withStringBody((string)json_encode([
                    'success' => true,
                    'message' => $message,
                    'redirect' => Router::url($redirect),
                ]));
        }

        $this->Flash->success($message);

        return $this->redirect($redirect);
    }

    private function errorResponse(string $message)
    {
        if ($this->request->is('ajax')) {
            return $this->response
                ->withType('application/json')
                ->withStatus(422)
                ->withStringBody((string)json_encode([
                    'success' => false,
                    'message' => $message,
                ]));
        }

        $this->Flash->error($message);

        return null;
    }
}
