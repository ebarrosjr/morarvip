<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plans Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Plan newEmptyEntity()
 * @method \App\Model\Entity\Plan newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Plan> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Plan get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Plan findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Plan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Plan> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Plan|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Plan saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Plan>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plan>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Plan>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plan> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Plan>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plan>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Plan>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plan> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PlansTable extends Table
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

        $this->setTable('plans');
        $this->setDisplayField('nome_com_valor');
        $this->setPrimaryKey('id');

        $this->hasMany('Users', [
            'foreignKey' => 'plan_id',
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
            ->maxLength('nome', 45)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

        $validator
            ->numeric('valor')
            ->greaterThanOrEqual('valor', 0)
            ->requirePresence('valor', 'create')
            ->notEmptyString('valor');

        $validator
            ->integer('dias_gratis')
            ->allowEmptyString('dias_gratis');

        return $validator;
    }
}
