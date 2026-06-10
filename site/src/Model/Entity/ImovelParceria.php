<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ImovelParceria Entity
 *
 * @property int $id
 * @property int $imovei_id
 * @property int $user_id
 * @property int $parceiro_id
 * @property \Cake\I18n\Date|null $inicio_parceria
 * @property float|null $porcentagem_parceiro
 * @property \Cake\I18n\Date|null $fim_parceria
 * @property string|null $situacao
 * @property string|null $observacao_reprovado
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property \Cake\I18n\DateTime|null $deleted
 *
 * @property \App\Model\Entity\Imovei $imovei
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\User $parceiro
 */
class ImovelParceria extends Entity
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
        'imovei_id' => true,
        'user_id' => true,
        'parceiro_id' => true,
        'inicio_parceria' => true,
        'porcentagem_parceiro' => true,
        'fim_parceria' => true,
        'situacao' => true,
        'observacao_reprovado' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'imovei' => true,
        'user' => true,
        'parceiro' => true,
    ];
}
