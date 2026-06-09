<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AtendimentosFixture
 */
class AtendimentosFixture extends TestFixture
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
                'pessoa_id' => 1,
                'imovel_id' => 1,
                'interesse' => 1,
                'atendido_por' => 1,
                'canal' => 'Lorem ipsum dolor sit amet',
                'descricao' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'conversao' => 'Lorem ipsum dolor sit amet',
                'nota' => 1,
                'created' => 1780611883,
                'modified' => 1780611883,
            ],
        ];
        parent::init();
    }
}
