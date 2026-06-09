<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pessoa Entity
 *
 * @property int $id
 * @property string|null $cpf
 * @property string $nome
 * @property \Cake\I18n\Date|null $nascimento
 * @property string|null $mae
 * @property string|null $pai
 * @property string|null $sexo
 * @property int|null $raca_id
 * @property string|null $estado_civil
 * @property string|null $nome_social
 * @property int|null $escolaridade_id
 * @property int|null $renda_id
 * @property int|null $religiao_id
 * @property string|null $email
 * @property string|null $cep
 * @property string|null $numero
 * @property string|null $complemento
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $telefone
 * @property string|null $whatsapp
 * @property string|null $telegram
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $foto
 * @property bool|null $propaganda
 * @property bool|null $share_data
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property \Cake\I18n\DateTime|null $deleted
 * @property string|null $origem
 * @property string|null $id_asaas
 * @property string|null $motivo
 *
 * @property \App\Model\Entity\Atendimento[] $atendimentos
 */
class Pessoa extends Entity
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
        'cpf' => true,
        'nome' => true,
        'nascimento' => true,
        'mae' => true,
        'pai' => true,
        'sexo' => true,
        'raca_id' => true,
        'estado_civil' => true,
        'nome_social' => true,
        'escolaridade_id' => true,
        'renda_id' => true,
        'religiao_id' => true,
        'email' => true,
        'cep' => true,
        'numero' => true,
        'complemento' => true,
        'latitude' => true,
        'longitude' => true,
        'telefone' => true,
        'whatsapp' => true,
        'telegram' => true,
        'facebook' => true,
        'instagram' => true,
        'foto' => true,
        'propaganda' => true,
        'share_data' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'origem' => true,
        'id_asaas' => true,
        'motivo' => true,
        'atendimentos' => true,
    ];
}
