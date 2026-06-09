<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $nome
 * @property string|null $cpf
 * @property string|null $alias
 * @property string|null $email
 * @property string $telefone
 * @property string|null $whatsapp
 * @property string|null $logo
 * @property string|null $password
 * @property string|null $creci
 * @property string|null $uf_creci
 * @property string|null $instagram
 * @property string|null $twitter
 * @property string|null $tiktok
 * @property string|null $facebook
 * @property int $plan_id
 * @property \Cake\I18n\Date|null $inicio_plano
 * @property string|null $asaas_customer_id
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property \Cake\I18n\DateTime|null $deleted
 *
 * @property \App\Model\Entity\Plan $plan
 * @property \App\Model\Entity\Imovei[] $imoveis
 */
class User extends Entity
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
        'nome' => true,
        'cpf' => true,
        'alias' => true,
        'email' => true,
        'activation_code' => true,
        'activation_date' => true,
        'telefone' => true,
        'whatsapp' => true,
        'logo' => true,
        'password' => true,
        'creci' => true,
        'uf_creci' => true,
        'instagram' => true,
        'twitter' => true,
        'tiktok' => true,
        'facebook' => true,
        'plan_id' => true,
        'inicio_plano' => true,
        'asaas_customer_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'plan' => true,
        'imoveis' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password): ?string
    {
        if (mb_strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
        return null;
    }    
}
