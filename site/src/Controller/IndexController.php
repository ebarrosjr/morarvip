<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;

class IndexController extends AppController
{

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
        $filtros = [
            'negocio' => $queryParams['negocio'] ?? 'V',
            'tipo_imovel' => array_values(array_filter((array)($queryParams['tipo_imovel'] ?? []), 'is_numeric')),
            'quartos' => $this->normalizePositiveInteger($queryParams['quartos'] ?? null),
            'banheiros' => $this->normalizePositiveInteger($queryParams['banheiros'] ?? null),
            'vagas' => $this->normalizePositiveInteger($queryParams['vagas'] ?? null),
            'preco_minimo' => $queryParams['preco_minimo'] ?? '',
            'preco_maximo' => $queryParams['preco_maximo'] ?? '',
        ];

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
                'TipoImoveis',
                'Users',
            ])
            ->leftJoin(
                ['FotoPrincipal' => 'foto_imoveis'],
                ['FotoPrincipal.id' => $fotoPrincipalOuPrimeira],
            )
            ->where(['Imoveis.show_site' => 1]);

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
        } catch (NotFoundException) {
            $queryParams['page'] = 1;

            return $this->redirect(['?' => $queryParams]);
        }

        $tipoImoveisTable = $tableLocator->get('TipoImoveis');
        $quantidadeImoveis = $imoveisTable->find();
        $quantidadeImoveis
            ->select(['quantidade' => $quantidadeImoveis->func()->count('*')])
            ->where(function ($exp) {
                return $exp->equalFields('Imoveis.tipo_imovel_id', 'TipoImoveis.id');
            })
            ->where(['Imoveis.show_site' => 1]);

        $tipoimoveis = $tipoImoveisTable
            ->find()
            ->select($tipoImoveisTable)
            ->select(['quantidade_imoveis' => $quantidadeImoveis])
            ->orderBy(['TipoImoveis.nome' => 'ASC'])
            ->all();

        $this->set(compact('imoveis', 'tipoimoveis', 'filtros'));
    }

    public function corretor($id)
    {
            $tableLocator = TableRegistry::getTableLocator();
            $usersTable = $tableLocator->get('Users');
            $corretor = $usersTable->get($id);

            $imoveisTable = $tableLocator->get('Imoveis');
            $imoveis = $imoveisTable
                ->find()
                ->where(['user_id' => $id, 'show_site' => 1, 'user_id IN ' => $tableLocator->get('ImovelParcerias')->find()->select(['parceiro_id'])->where(['fim_parceria > NOW()', 'situacao' => 'A'])])
                ->orderBy(['created' => 'DESC'])
                ->all();


            $this->set(compact('corretor', 'imoveis'));
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
}
