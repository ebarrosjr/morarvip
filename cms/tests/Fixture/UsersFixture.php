<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'nome' => 'Lorem ipsum dolor sit amet',
                'cpf' => 'Lorem ips',
                'alias' => 'Lorem ipsum d',
                'email' => 'Lorem ipsum dolor sit amet',
                'telefone' => 'Lorem ipsum d',
                'whatsapp' => 'Lorem ipsum d',
                'logo' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'creci' => 'Lorem ipsum d',
                'uf_creci' => 'Lo',
                'instagram' => 'Lorem ipsum dolor sit amet',
                'twitter' => 'Lorem ipsum dolor sit amet',
                'tiktok' => 'Lorem ipsum dolor sit amet',
                'facebook' => 'Lorem ipsum dolor sit amet',
                'plan_id' => 1,
                'inicio_plano' => '2026-06-04',
                'asaas_customer_id' => 'Lorem ipsum dolor sit amet',
                'created' => 1780611894,
                'modified' => 1780611894,
                'deleted' => 1780611894,
            ],
        ];
        parent::init();
    }
}
