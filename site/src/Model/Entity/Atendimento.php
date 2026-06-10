<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Atendimento Entity
 *
 * @property int $id
 * @property int $pessoa_id
 * @property int|null $imovel_id
 * @property bool|null $interesse
 * @property int|null $atendido_por
 * @property string|null $canal
 * @property string|null $descricao
 * @property string|null $conversao
 * @property int|null $nota
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Pessoa $pessoa
 * @property \App\Model\Entity\User|null $user
 * @property \App\Model\Entity\Imovei|null $imovei
 */
class Atendimento extends Entity
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
        'pessoa_id' => true,
        'imovel_id' => true,
        'interesse' => true,
        'atendido_por' => true,
        'canal' => true,
        'descricao' => true,
        'conversao' => true,
        'nota' => true,
        'created' => true,
        'modified' => true,
        'pessoa' => true,
        'user' => true,
        'imovei' => true,
    ];
}
