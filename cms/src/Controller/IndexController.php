<?php
namespace App\Controller;

use App\Controller\AppController;

class IndexController extends AppController
{
    public function index()
    {
        $userId = (int)$this->Authentication->getIdentity()->getIdentifier();
        $imoveisPermitidos = $this->accessibleImovelIdsQuery($userId);
        $atendimentoScope = $this->allowedAtendimentoScope($userId, $imoveisPermitidos);

        $imoveisCadastrados = $this->accessibleImoveisQuery($userId)->count();
        $pessoasCadastradas = $this->ownedPropertyOwnersQuery($userId)->count();
        $visitasAgendadasMes = $this->fetchTable('Atendimentos')
            ->find()
            ->where([
                $atendimentoScope,
                'Atendimentos.interesse' => true,
                'Atendimentos.created >=' => date('Y-m-01 00:00:00'),
                'Atendimentos.created <=' => date('Y-m-t 23:59:59'),
            ])
            ->count();
        $atendimentosPendentes = $this->fetchTable('Atendimentos')
            ->find()
            ->where([
                $atendimentoScope,
                'OR' => [
                    'Atendimentos.conversao IS' => null,
                    'Atendimentos.conversao' => 'N',
                ],
            ])
            ->count();

        $imoveisPorBairroQuery = $this->accessibleImoveisQuery($userId);
        $imoveisPorBairro = $imoveisPorBairroQuery
            ->select([
                'bairro' => 'Imoveis.bairro',
                'total' => $imoveisPorBairroQuery->func()->count('*'),
            ])
            ->where([
                'Imoveis.bairro IS NOT' => null,
                'Imoveis.bairro <>' => '',
            ])
            ->groupBy(['Imoveis.bairro'])
            ->orderByDesc('total')
            ->limit(5)
            ->enableHydration(false)
            ->toArray();

        $this->set(compact(
            'imoveisCadastrados',
            'pessoasCadastradas',
            'visitasAgendadasMes',
            'atendimentosPendentes',
            'imoveisPorBairro'
        ));
    }

    private function accessibleImoveisQuery(int $userId)
    {
        $imoveisEmParceria = $this->validPartnershipImoveisQuery($userId);

        return $this->fetchTable('Imoveis')
            ->find()
            ->where([
                'OR' => [
                    'Imoveis.user_id' => $userId,
                    'Imoveis.id IN' => $imoveisEmParceria,
                ],
            ]);
    }

    private function accessibleImovelIdsQuery(int $userId)
    {
        return $this->accessibleImoveisQuery($userId)
            ->select(['Imoveis.id']);
    }

    private function validPartnershipImoveisQuery(int $userId)
    {
        $today = date('Y-m-d');

        return $this->fetchTable('ImovelParcerias')
            ->find()
            ->select(['ImovelParcerias.imovei_id'])
            ->where([
                'ImovelParcerias.parceiro_id' => $userId,
                'ImovelParcerias.situacao' => 'A',
                'ImovelParcerias.deleted IS' => null,
                [
                    'OR' => [
                        'ImovelParcerias.inicio_parceria IS' => null,
                        'ImovelParcerias.inicio_parceria <=' => $today,
                    ],
                ],
                [
                    'OR' => [
                        'ImovelParcerias.fim_parceria IS' => null,
                        'ImovelParcerias.fim_parceria >=' => $today,
                    ],
                ],
            ]);
    }

    private function ownedPropertyOwnersQuery(int $userId)
    {
        $proprietarios = $this->fetchTable('Imoveis')
            ->find()
            ->select(['Imoveis.proprietario'])
            ->where([
                'Imoveis.user_id' => $userId,
                'Imoveis.proprietario IS NOT' => null,
            ])
            ->distinct(['Imoveis.proprietario']);

        return $this->fetchTable('Pessoas')
            ->find()
            ->where(['Pessoas.id IN' => $proprietarios]);
    }

    private function allowedAtendimentoScope(int $userId, $imoveisPermitidos): array
    {
        return [
            'OR' => [
                ['Atendimentos.imovel_id IN' => $imoveisPermitidos],
                [
                    'Atendimentos.imovel_id IS' => null,
                    'Atendimentos.atendido_por' => $userId,
                ],
            ],
        ];
    }
}
