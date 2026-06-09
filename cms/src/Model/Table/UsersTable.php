<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\PlansTable&\Cake\ORM\Association\BelongsTo $Plans
 * @property \App\Model\Table\ImoveisTable&\Cake\ORM\Association\HasMany $Imoveis
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\User> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\User> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Plans', [
            'foreignKey' => 'plan_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Imoveis', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('nome')
            ->maxLength('nome', 120)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('cpf')
            ->maxLength('cpf', 11)
            ->allowEmptyString('cpf')
            ->add('cpf', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('alias')
            ->maxLength('alias', 15)
            ->allowEmptyString('alias')
            ->add('alias', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('telefone')
            ->maxLength('telefone', 15)
            ->requirePresence('telefone', 'create')
            ->notEmptyString('telefone');

        $validator
            ->scalar('whatsapp')
            ->maxLength('whatsapp', 15)
            ->allowEmptyString('whatsapp');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 150)
            ->allowEmptyString('logo');

        $validator
            ->scalar('password')
            ->maxLength('password', 150)
            ->allowEmptyString('password');

        $validator
            ->scalar('creci')
            ->maxLength('creci', 15)
            ->allowEmptyString('creci');

        $validator
            ->scalar('uf_creci')
            ->maxLength('uf_creci', 2)
            ->allowEmptyString('uf_creci');

        $validator
            ->scalar('instagram')
            ->maxLength('instagram', 150)
            ->allowEmptyString('instagram');

        $validator
            ->scalar('twitter')
            ->maxLength('twitter', 150)
            ->allowEmptyString('twitter');

        $validator
            ->scalar('tiktok')
            ->maxLength('tiktok', 150)
            ->allowEmptyString('tiktok');

        $validator
            ->scalar('facebook')
            ->maxLength('facebook', 150)
            ->allowEmptyString('facebook');

        $validator
            ->nonNegativeInteger('plan_id')
            ->notEmptyString('plan_id');

        $validator
            ->date('inicio_plano')
            ->allowEmptyDate('inicio_plano');

        $validator
            ->scalar('asaas_customer_id')
            ->maxLength('asaas_customer_id', 45)
            ->allowEmptyString('asaas_customer_id');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);
        $rules->add($rules->isUnique(['cpf'], ['allowMultipleNulls' => true]), ['errorField' => 'cpf']);
        $rules->add($rules->isUnique(['alias'], ['allowMultipleNulls' => true]), ['errorField' => 'alias']);
        $rules->add($rules->existsIn(['plan_id'], 'Plans'), ['errorField' => 'plan_id']);

        return $rules;
    }
}
