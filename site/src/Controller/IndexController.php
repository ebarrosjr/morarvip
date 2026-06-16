<?php
namespace App\Controller;

use App\Controller\AppController;
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

        $imoveis = $imoveisTable
            ->find()
            ->select($imoveisTable)
            ->select(['foto_principal' => 'FotoPrincipal.arquivo'])
            ->leftJoin(
                ['FotoPrincipal' => 'foto_imoveis'],
                ['FotoPrincipal.id' => $fotoPrincipalOuPrimeira],
            )
            ->where(['Imoveis.show_site' => 1])
            ->orderBy(['Imoveis.created' => 'DESC'])
            ->all();

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

        $this->set(compact('imoveis', 'tipoimoveis'));
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
}
