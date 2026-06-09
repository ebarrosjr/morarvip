<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PessoasFixture
 */
class PessoasFixture extends TestFixture
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
                'cpf' => 'Lorem ipsum d',
                'nome' => 'Lorem ipsum dolor sit amet',
                'nascimento' => '2026-06-04',
                'mae' => 'Lorem ipsum dolor sit amet',
                'pai' => 'Lorem ipsum dolor sit amet',
                'sexo' => 'Lorem ipsum dolor sit amet',
                'raca_id' => 1,
                'estado_civil' => '',
                'nome_social' => 'Lorem ipsum dolor sit amet',
                'escolaridade_id' => 1,
                'renda_id' => 1,
                'religiao_id' => 1,
                'email' => 'Lorem ipsum dolor sit amet',
                'cep' => 'Lorem ip',
                'numero' => 'Lorem ip',
                'complemento' => 'Lorem ipsum dolor sit amet',
                'latitude' => 1.5,
                'longitude' => 1.5,
                'telefone' => 'Lorem ipsum dolor sit amet',
                'whatsapp' => 'Lorem ipsum dolor sit amet',
                'telegram' => 'Lorem ipsum dolor sit amet',
                'facebook' => 'Lorem ipsum dolor sit amet',
                'instagram' => 'Lorem ipsum dolor sit amet',
                'foto' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'propaganda' => 1,
                'share_data' => 1,
                'created' => 1780611895,
                'modified' => 1780611895,
                'deleted' => 1780611895,
                'origem' => 'Lorem ipsum dolor sit amet',
                'id_asaas' => 'Lorem ipsum dolor sit amet',
                'motivo' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            ],
        ];
        parent::init();
    }
}
