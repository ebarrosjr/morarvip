<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Imovei Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $proprietario
 * @property string|null $titulo
 * @property string|null $chamada
 * @property string|null $descricao
 * @property string|null $cep
 * @property string|null $numero
 * @property string|null $complemento
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int|null $vaga_garagem
 * @property int|null $banheiros
 * @property int|null $tamanho
 * @property int|null $quartos
 * @property string|null $foto
 * @property int|null $tipo_imovel_id
 * @property string|null $construtora
 * @property string|null $negocio
 * @property int|null $categoria_id
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property \Cake\I18n\DateTime|null $deleted
 * @property string|null $situacao
 * @property float|null $valor
 * @property float|null $iptu
 * @property float|null $comissao
 * @property int|null $show_site
 * @property int|null $show_preco_site
 * @property int|null $comissao_permanente
 * @property string|null $tipo_comissao
 * @property int|null $financia
 * @property int|null $corretor_opcionista
 * @property int|null $exclusividade
 * @property \Cake\I18n\Date|null $inicio_exclusividade
 * @property \Cake\I18n\Date|null $fim_exclusividade
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Categoria $categoria
 */
class Imovei extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'proprietario' => true,
        'titulo' => true,
        'chamada' => true,
        'descricao' => true,
        'cep' => true,
        'numero' => true,
        'complemento' => true,
        'latitude' => true,
        'longitude' => true,
        'vaga_garagem' => true,
        'banheiros' => true,
        'tamanho' => true,
        'quartos' => true,
        'foto' => true,
        'tipo_imovel_id' => true,
        'construtora' => true,
        'negocio' => true,
        'categoria_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'situacao' => true,
        'valor' => true,
        'iptu' => true,
        'comissao' => true,
        'show_site' => true,
        'show_preco_site' => true,
        'comissao_permanente' => true,
        'tipo_comissao' => true,
        'financia' => true,
        'parceiria' => true,
        'porcentagem_parceiro' => true,        
        'corretor_opcionista' => true,
        'exclusividade' => true,
        'inicio_exclusividade' => true,
        'fim_exclusividade' => true,
        'votos' => true,
        'nota' => true,
        'user' => true,
        'categoria' => true,
    ];
}
