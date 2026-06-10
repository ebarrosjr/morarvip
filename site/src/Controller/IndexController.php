<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class IndexController extends AppController
{

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

        $this->set(compact('imoveis'));
    }
}
