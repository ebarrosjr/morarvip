<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;

class IndexController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->Authentication->disableIdentityCheck();
    }    

    public function soon()
    {
        $this->viewBuilder()->setLayout('ajax');
    }

    public function index()
    {
        $tableLocator = TableRegistry::getTableLocator();
        $imoveisTable = $tableLocator->get('Imoveis');
        $fotoImoveisTable = $tableLocator->get('FotoImoveis');
        $queryParams = $this->request->getQueryParams();
        $filtros = $this->getFiltros($queryParams);
        $imoveisQuery = $this->buildImoveisQuery($imoveisTable, $fotoImoveisTable, $filtros);

        $this->paginate = [
            'limit' => 10,
            'order' => ['Imoveis.created' => 'DESC'],
            'sortableFields' => [
                'Imoveis.created',
                'Imoveis.valor',
                'Imoveis.titulo',
            ],
        ];

        try {
            $imoveis = $this->paginate($imoveisQuery);
        } catch (NotFoundException $exception) {
            $queryParams['page'] = 1;

            return $this->redirect(['?' => $queryParams]);
        }

        $tipoimoveis = $this->getTipoImoveisComQuantidade($imoveisTable, $tableLocator->get('TipoImoveis'));
        $cidades = $this->getCidadesComImoveis($imoveisTable);
        $bairros = $this->getBairrosPorCidade($imoveisTable, $filtros['cidade'], null, $filtros['negocio']);

        $this->set(compact('imoveis', 'tipoimoveis', 'cidades', 'bairros', 'filtros'));
    }

    public function corretor($id)
    {
        $corretorId = (int)$id;
        $tableLocator = TableRegistry::getTableLocator();
        $usersTable = $tableLocator->get('Users');
        $corretor = $usersTable->get($corretorId);
        $imoveisTable = $tableLocator->get('Imoveis');
        $fotoImoveisTable = $tableLocator->get('FotoImoveis');
        $queryParams = $this->request->getQueryParams();
        $filtros = $this->getFiltros($queryParams);
        $imoveisQuery = $this->buildImoveisQuery($imoveisTable, $fotoImoveisTable, $filtros, $corretorId);

        $this->paginate = [
            'limit' => 10,
            'order' => ['Imoveis.created' => 'DESC'],
            'sortableFields' => [
                'Imoveis.created',
                'Imoveis.valor',
                'Imoveis.titulo',
            ],
        ];

        try {
            $imoveis = $this->paginate($imoveisQuery);
        } catch (NotFoundException $exception) {
            $queryParams['page'] = 1;

            return $this->redirect(['action' => 'corretor', $corretorId, '?' => $queryParams]);
        }

        $tipoimoveis = $this->getTipoImoveisComQuantidade($imoveisTable, $tableLocator->get('TipoImoveis'), $corretorId);
        $cidades = $this->getCidadesComImoveis($imoveisTable, $corretorId);
        $bairros = $this->getBairrosPorCidade($imoveisTable, $filtros['cidade'], $corretorId, $filtros['negocio']);

        $this->set(compact('corretor', 'imoveis', 'tipoimoveis', 'cidades', 'bairros', 'filtros'));
    }

    public function bairrosPorCidade()
    {
        $this->request->allowMethod(['get']);

        $cidade = trim((string)$this->request->getQuery('cidade', ''));
        $corretorId = $this->normalizePositiveInteger($this->request->getQuery('corretor_id'));
        $negocio = (string)$this->request->getQuery('negocio', '');
        $bairros = [];

        if ($cidade !== '') {
            $bairros = $this->getBairrosPorCidade(
                TableRegistry::getTableLocator()->get('Imoveis'),
                $cidade,
                $corretorId,
                $negocio
            );
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody((string)json_encode([
                'success' => true,
                'bairros' => $bairros,
            ]));
    }

    public function detalheImovel($id)
    {
        $imovelId = (int)$id;
        $tableLocator = TableRegistry::getTableLocator();
        $imoveisTable = $tableLocator->get('Imoveis');

        $imovel = $imoveisTable->get($imovelId, contain: [
            'FotoImoveis' => function ($q) {
                return $q->orderBy([
                    'FotoImoveis.principal' => 'DESC',
                    'FotoImoveis.id' => 'ASC',
                ]);
            },
            'TipoImoveis',
            'Users',
        ]);

        if (!$imovel->show_site) {
            throw new NotFoundException('Imóvel não encontrado');
        }

        $slug = strtolower(Text::slug($imovel->titulo ?: 'imovel'));
        if ($this->request->getParam('slug') !== $slug) {
            return $this->redirect([
                'controller' => 'Index',
                'action' => 'detalheImovel',
                'id' => $imovelId,
                'slug' => $slug,
            ], 301);
        }

        $imoveisCorretor = $imoveisTable
            ->find()
            ->contain([
                'FotoImoveis' => function ($q) {
                    return $q->orderBy([
                        'FotoImoveis.principal' => 'DESC',
                        'FotoImoveis.id' => 'ASC',
                    ]);
                },
                'TipoImoveis',
                'Users',
            ])
            ->where([
                'Imoveis.show_site' => 1,
                'Imoveis.user_id' => $imovel->user_id,
                'Imoveis.id !=' => $imovelId,
            ])
            ->orderBy(['Imoveis.created' => 'DESC'])
            ->limit(3)
            ->all();

        $imoveisSimilares = $imoveisTable
            ->find()
            ->contain([
                'FotoImoveis' => function ($q) {
                    return $q->orderBy([
                        'FotoImoveis.principal' => 'DESC',
                        'FotoImoveis.id' => 'ASC',
                    ]);
                },
                'TipoImoveis',
                'Users',
            ])
            ->where([
                'Imoveis.show_site' => 1,
                'Imoveis.id !=' => $imovelId,
            ])
            ->orderBy(['Imoveis.created' => 'DESC'])
            ->limit(3);

        if (!empty($imovel->tipo_imovel_id)) {
            $imoveisSimilares->where(['Imoveis.tipo_imovel_id' => $imovel->tipo_imovel_id]);
        }

        $this->set([
            'imovel' => $imovel,
            'imoveisCorretor' => $imoveisCorretor,
            'imoveisSimilares' => $imoveisSimilares->all(),
        ]);
    }

    private function getFiltros(array $queryParams): array
    {
        return [
            'negocio' => in_array(($queryParams['negocio'] ?? ''), ['V', 'A', 'L'], true) ? $queryParams['negocio'] : '',
            'tipo_imovel' => array_values(array_filter((array)($queryParams['tipo_imovel'] ?? []), 'is_numeric')),
            'quartos' => $this->normalizePositiveInteger($queryParams['quartos'] ?? null),
            'banheiros' => $this->normalizePositiveInteger($queryParams['banheiros'] ?? null),
            'vagas' => $this->normalizePositiveInteger($queryParams['vagas'] ?? null),
            'preco_minimo' => $queryParams['preco_minimo'] ?? '',
            'preco_maximo' => $queryParams['preco_maximo'] ?? '',
            'cidade' => trim((string)($queryParams['cidade'] ?? '')),
            'bairro' => trim((string)($queryParams['bairro'] ?? '')),
            'q' => trim((string)($queryParams['q'] ?? '')),
        ];
    }

    private function buildImoveisQuery($imoveisTable, $fotoImoveisTable, array $filtros, ?int $corretorId = null)
    {
        $fotoPrincipalOuPrimeira = $fotoImoveisTable
            ->find()
            ->select(['FotoImoveis.id'])
            ->where(function ($exp) {
                return $exp->equalFields('FotoImoveis.imovel_id', 'Imoveis.id');
            })
            ->orderBy([
                'FotoImoveis.principal' => 'DESC',
                'FotoImoveis.id' => 'ASC',
            ])
            ->limit(1);

        $imoveisQuery = $imoveisTable
            ->find()
            ->select($imoveisTable)
            ->select(['foto_principal' => 'FotoPrincipal.arquivo'])
            ->contain([
                'FotoImoveis' => function ($q) {
                    return $q->orderBy([
                        'FotoImoveis.principal' => 'DESC',
                        'FotoImoveis.id' => 'ASC',
                    ]);
                },
                'TipoImoveis' => function ($q) {
                    return $q->select(['TipoImoveis.id', 'TipoImoveis.nome']);
                },
                'Users' => function ($q) {
                    return $q->select(['Users.id', 'Users.nome', 'Users.logo']);
                },
            ])
            ->leftJoin(
                ['FotoPrincipal' => 'foto_imoveis'],
                ['FotoPrincipal.id' => $fotoPrincipalOuPrimeira],
            )
            ->where(['Imoveis.show_site' => 1]);

        if ($corretorId !== null) {
            $imoveisQuery->where(['Imoveis.user_id' => $corretorId]);
        }

        $this->applyFiltros($imoveisQuery, $filtros);

        return $imoveisQuery;
    }

    private function applyFiltros($imoveisQuery, array $filtros): void
    {
        if ($filtros['q'] !== '') {
            $termoBusca = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filtros['q']) . '%';
            $imoveisQuery->where(function ($exp) use ($termoBusca) {
                return $exp->or([
                    'Imoveis.titulo LIKE' => $termoBusca,
                    'Imoveis.chamada LIKE' => $termoBusca,
                    'Imoveis.descricao LIKE' => $termoBusca,
                    'Imoveis.cep LIKE' => $termoBusca,
                    'Imoveis.complemento LIKE' => $termoBusca,
                    'Imoveis.cidade LIKE' => $termoBusca,
                    'Imoveis.bairro LIKE' => $termoBusca,
                    'TipoImoveis.nome LIKE' => $termoBusca,
                ]);
            });
        }

        if ($filtros['cidade'] !== '') {
            $imoveisQuery->where(['Imoveis.cidade' => $filtros['cidade']]);
        }

        if ($filtros['bairro'] !== '') {
            $imoveisQuery->where(['Imoveis.bairro' => $filtros['bairro']]);
        }

        if (in_array($filtros['negocio'], ['V', 'A', 'L'], true)) {
            $imoveisQuery->where(['Imoveis.negocio' => $filtros['negocio']]);
        }

        if (!empty($filtros['tipo_imovel'])) {
            $imoveisQuery->where(['Imoveis.tipo_imovel_id IN' => $filtros['tipo_imovel']]);
        }

        if ($filtros['quartos'] !== null) {
            $imoveisQuery->where(['Imoveis.quartos >=' => $filtros['quartos']]);
        }

        if ($filtros['banheiros'] !== null) {
            $imoveisQuery->where(['Imoveis.banheiros >=' => $filtros['banheiros']]);
        }

        if ($filtros['vagas'] !== null) {
            $imoveisQuery->where(['Imoveis.vaga_garagem >=' => $filtros['vagas']]);
        }

        $precoMinimo = $this->normalizeMoney($filtros['preco_minimo']);
        if ($precoMinimo !== null) {
            $imoveisQuery->where(['Imoveis.valor >=' => $precoMinimo]);
        }

        $precoMaximo = $this->normalizeMoney($filtros['preco_maximo']);
        if ($precoMaximo !== null) {
            $imoveisQuery->where(['Imoveis.valor <=' => $precoMaximo]);
        }
    }

    private function getTipoImoveisComQuantidade($imoveisTable, $tipoImoveisTable, ?int $corretorId = null)
    {
        $quantidadeImoveis = $imoveisTable->find();
        $quantidadeImoveis
            ->select(['quantidade' => $quantidadeImoveis->func()->count('*')])
            ->where(function ($exp) {
                return $exp->equalFields('Imoveis.tipo_imovel_id', 'TipoImoveis.id');
            })
            ->where(['Imoveis.show_site' => 1]);

        if ($corretorId !== null) {
            $quantidadeImoveis->where(['Imoveis.user_id' => $corretorId]);
        }

        return $tipoImoveisTable
            ->find()
            ->select($tipoImoveisTable)
            ->select(['quantidade_imoveis' => $quantidadeImoveis])
            ->orderBy(['TipoImoveis.nome' => 'ASC'])
            ->all();
    }

    private function getCidadesComImoveis($imoveisTable, ?int $corretorId = null): array
    {
        $query = $imoveisTable
            ->find()
            ->select(['cidade' => 'Imoveis.cidade'])
            ->distinct(['Imoveis.cidade'])
            ->where([
                'Imoveis.show_site' => 1,
                'Imoveis.cidade IS NOT' => null,
                'Imoveis.cidade <>' => '',
            ])
            ->orderBy(['Imoveis.cidade' => 'ASC'])
            ->enableHydration(false);

        if ($corretorId !== null) {
            $query->where(['Imoveis.user_id' => $corretorId]);
        }

        $cidades = [];
        foreach ($query as $row) {
            $cidades[] = $row['cidade'];
        }

        return $cidades;
    }

    private function getBairrosPorCidade($imoveisTable, string $cidade, ?int $corretorId = null, ?string $negocio = null): array
    {
        $cidade = trim($cidade);
        if ($cidade === '') {
            return [];
        }

        $query = $imoveisTable
            ->find()
            ->select(['bairro' => 'Imoveis.bairro'])
            ->distinct(['Imoveis.bairro'])
            ->where([
                'Imoveis.show_site' => 1,
                'Imoveis.cidade' => $cidade,
                'Imoveis.bairro IS NOT' => null,
                'Imoveis.bairro <>' => '',
            ])
            ->orderBy(['Imoveis.bairro' => 'ASC'])
            ->enableHydration(false);

        if ($corretorId !== null) {
            $query->where(['Imoveis.user_id' => $corretorId]);
        }

        if (in_array($negocio, ['V', 'A', 'L'], true)) {
            $query->where(['Imoveis.negocio' => $negocio]);
        }

        $bairros = [];
        foreach ($query as $row) {
            $bairros[] = $row['bairro'];
        }

        return $bairros;
    }

    private function normalizePositiveInteger(mixed $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        $value = filter_var($value, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        return $value === false ? null : $value;
    }

    private function normalizeMoney(mixed $value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        $value = preg_replace('/[^\d,.]/', '', (string)$value);
        if ($value === null || $value === '') {
            return null;
        }

        if (str_contains($value, ',') && str_contains($value, '.')) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        } else {
            $value = str_replace(',', '.', $value);
        }

        return is_numeric($value) ? (float)$value : null;
    }

    public function consultoriaImobiliaria()
    {
    }

    public function termosDeUso()
    {
    }

    public function politicaDePrivacidade()
    {
    }
}
