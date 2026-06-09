<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FotoImoveisFixture
 */
class FotoImoveisFixture extends TestFixture
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
                'imovel_id' => 1,
                'arquivo' => 'Lorem ipsum dolor sit amet',
                'principal' => 1,
                'created' => 1780611894,
                'modified' => 1780611894,
            ],
        ];
        parent::init();
    }
}
