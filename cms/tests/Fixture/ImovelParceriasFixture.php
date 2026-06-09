<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ImovelParceriasFixture
 */
class ImovelParceriasFixture extends TestFixture
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
                'imovei_id' => 1,
                'user_id' => 1,
                'parceiro_id' => 1,
                'inicio_parceria' => '2026-06-09',
                'porcentagem_parceiro' => 1,
                'fim_parceria' => '2026-06-09',
                'situacao' => 'Lorem ipsum dolor sit amet',
                'observacao_reprovado' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => 1781022344,
                'modified' => 1781022344,
                'deleted' => 1781022344,
            ],
        ];
        parent::init();
    }
}
