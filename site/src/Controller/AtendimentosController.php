<?php
declare(strict_types=1);

namespace App\Controller;

class AtendimentosController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['interesse']);
    }

    public function interesse()
    {
        $this->request->allowMethod(['post']);

        $data = $this->request->getData();
        $imovelId = (int)($data['imovel_id'] ?? 0);
        $nome = trim((string)($data['nome'] ?? ''));
        $email = trim((string)($data['email'] ?? ''));
        $mensagem = trim((string)($data['mensagem'] ?? ''));

        if ($imovelId <= 0 || $nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $mensagem === '') {
            $this->Flash->error(__('Informe nome, e-mail e mensagem para registrar seu interesse.'), ['key' => 'property_contact']);

            return $this->redirect($this->referer(['controller' => 'Index', 'action' => 'index'], true));
        }

        $imovel = $this->fetchTable('Imoveis')
            ->find()
            ->where([
                'Imoveis.id' => $imovelId,
                'Imoveis.show_site' => 1,
            ])
            ->first();

        if (!$imovel) {
            $this->Flash->error(__('Não foi possível localizar o imóvel informado.'), ['key' => 'property_contact']);

            return $this->redirect($this->referer(['controller' => 'Index', 'action' => 'index'], true));
        }

        $pessoas = $this->fetchTable('Pessoas');
        $pessoa = $pessoas->find()
            ->where(['Pessoas.email' => $email])
            ->first();

        $pessoaData = [
            'nome' => $nome,
            'email' => $email,
            'origem' => 'S',
        ];

        if ($pessoa) {
            $pessoa = $pessoas->patchEntity($pessoa, $pessoaData, [
                'fields' => ['nome', 'email', 'origem'],
            ]);
        } else {
            $pessoa = $pessoas->newEntity($pessoaData, [
                'fields' => ['nome', 'email', 'origem'],
            ]);
        }

        if (!$pessoas->save($pessoa)) {
            $this->Flash->error(__('Não foi possível salvar seus dados de contato.'), ['key' => 'property_contact']);

            return $this->redirect($this->referer(['controller' => 'Index', 'action' => 'index'], true));
        }

        $atendimento = $this->Atendimentos->newEntity([
            'pessoa_id' => $pessoa->id,
            'imovel_id' => $imovel->id,
            'interesse' => 1,
            'canal' => 'E',
            'descricao' => $mensagem,
            'conversao' => 'X',
        ], [
            'fields' => ['pessoa_id', 'imovel_id', 'interesse', 'canal', 'descricao', 'conversao'],
        ]);

        if ($this->Atendimentos->save($atendimento)) {
            $this->Flash->success(__('Interesse informado ao corretor, em breve receberá um contato.'), ['key' => 'property_contact']);
        } else {
            $this->Flash->error(__('Não foi possível registrar seu interesse. Tente novamente.'), ['key' => 'property_contact']);
        }

        return $this->redirect($this->referer(['controller' => 'Index', 'action' => 'index'], true));
    }
}
