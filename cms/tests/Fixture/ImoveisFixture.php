<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ImoveisFixture
 */
class ImoveisFixture extends TestFixture
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
                'user_id' => 1,
                'proprietario' => 1,
                'titulo' => 'Lorem ipsum dolor sit amet',
                'chamada' => 'Lorem ipsum dolor sit amet',
                'descricao' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'cep' => 'Lorem ip',
                'numero' => 'Lorem ip',
                'complemento' => 'Lorem ipsum dolor sit amet',
                'latitude' => 1.5,
                'longitude' => 1.5,
                'vaga_garagem' => 1,
                'banheiros' => 1,
                'tamanho' => 1,
                'quartos' => 1,
                'foto' => 'Lorem ipsum dolor sit amet',
                'tipo_imovel_id' => 1,
                'construtora' => 'Lorem ipsum dolor sit amet',
                'negocio' => 'Lorem ipsum dolor sit amet',
                'categoria_id' => 1,
                'created' => 1780688488,
                'modified' => 1780688488,
                'deleted' => 1780688488,
                'situacao' => 'Lorem ipsum dolor sit amet',
                'valor' => 1,
                'iptu' => 1,
                'comissao' => 1,
                'show_site' => 1,
                'show_preco_site' => 1,
                'comissao_permanente' => 1,
                'tipo_comissao' => 'Lorem ipsum dolor sit amet',
                'financia' => 1,
                'corretor_opcionista' => 1,
                'exclusividade' => 1,
                'inicio_exclusividade' => '2026-06-05',
                'fim_exclusividade' => '2026-06-05',
            ],
        ];
        parent::init();
    }
}
