<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Service\EnderecoService;

class PessoasController extends AppController
{

    private array $escolaridades = [
        1 => 'Analfabeto',
        2 => 'Ensino Fundamental Incompleto',
        3 => 'Ensino Fundamental Completo',
        4 => 'Ensino Médio Incompleto',
        5 => 'Ensino Médio Completo',
        6 => 'Ensino Superior Incompleto',
        7 => 'Ensino Superior Completo',
        8 => 'Pós-Graduação Incompleta',
        9 => 'Pós-Graduação Completa',
        10 => 'Mestrado',
        11 => 'Doutorado',
    ];

    private array $estadoCivil = [
        'S' => 'Solteiro', 
        'C' => 'Casado', 
        'E' => 'Unido Estável',
        'X' => 'Separado',
        'D' => 'Divorciado', 
        'V' => 'Viúvo'
    ];

    private array $rendaFamiliar = [
        1 => 'Ate 1 salário mínimo',
        2 => 'De 1 a 2 salários mínimos',
        3 => 'De 2 a 3 salários mínimos',
        4 => 'De 3 a 5 salários mínimos',
        5 => 'Mais de 5 salários mínimos',
    ];

    public function index()
    {
        $xPessoas = $this->Pessoas
            ->find()
            ->where(['Pessoas.id' => 0]);
        $pessoas = $this->paginate($xPessoas);
        $pageTitle = 'Compradores/Locatários';
        $breadcrumbTitle = 'Clientes';

        $this->set(compact('pessoas', 'pageTitle', 'breadcrumbTitle'));
    }

    public function proprietarios()
    {
        $xPessoas = $this->ownedPropertyOwnersQuery();
        $pessoas = $this->paginate($xPessoas);
        $pageTitle = 'Proprietários/Locadores';
        $breadcrumbTitle = 'Proprietários';

        $this->set(compact('pessoas', 'pageTitle', 'breadcrumbTitle'));
        $this->render('index');
    }

    public function add()
    {
        $pessoa = $this->Pessoas->newEmptyEntity();
        if ($this->request->is('post')) {
            $dados = $this->request->getData();
            $dados['origem'] = 'C';
            $pessoa = $this->Pessoas->patchEntity($pessoa, $dados);
            if ($this->Pessoas->save($pessoa)) {
                $this->Flash->success(__('The pessoa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pessoa could not be saved. Please, try again.'));
        }
        $escolaridades = $this->escolaridades;
        $estadoCivil = $this->estadoCivil;
        $rendaFamiliar = $this->rendaFamiliar;
        $this->set(compact('pessoa', 'escolaridades', 'estadoCivil', 'rendaFamiliar'));
    }

    public function edit($id = null)
    {
        $pessoa = $this->Pessoas->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pessoa = $this->Pessoas->patchEntity($pessoa, $this->request->getData());
            if ($this->Pessoas->save($pessoa)) {
                $this->Flash->success(__('The pessoa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pessoa could not be saved. Please, try again.'));
        }
        $escolaridades = $this->escolaridades;
        $estadoCivil = $this->estadoCivil;
        $rendaFamiliar = $this->rendaFamiliar;
        $this->set(compact('pessoa', 'escolaridades', 'estadoCivil', 'rendaFamiliar'));
    }

    public function enderecoPorCep($cep = null)
    {
        $this->request->allowMethod(['get']);

        $endereco = EnderecoService::getEnderecoByCep((string)$cep);
        if (!$endereco) {
            return $this->response
                ->withType('application/json')
                ->withStatus(404)
                ->withStringBody((string)json_encode([
                    'success' => false,
                    'message' => 'CEP não encontrado.',
                ]));
        }

        $logradouro = trim((string)($endereco['logradouro'] ?? ''));
        $fallback = trim((string)($endereco['bairro'] ?? ''))
            ?: trim((string)($endereco['cidade'] ?? ''))
            ?: trim((string)($endereco['estado'] ?? ''));
        $logradouro = $logradouro !== '' ? $logradouro : $fallback;

        $addressString = EnderecoService::buildAddressString($endereco);
        $coordenadas = EnderecoService::getCoordenadas($addressString);

        return $this->response
            ->withType('application/json')
            ->withStringBody((string)json_encode([
                'success' => true,
                'cep' => $endereco['cep'] ?? EnderecoService::normalizeCep((string)$cep),
                'logradouro' => $logradouro,
                'bairro' => $endereco['bairro'] ?? null,
                'cidade' => $endereco['cidade'] ?? null,
                'uf' => $endereco['estado'] ?? null,
                'latitude' => $coordenadas['latitude'] ?? null,
                'longitude' => $coordenadas['longitude'] ?? null,
            ]));
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
