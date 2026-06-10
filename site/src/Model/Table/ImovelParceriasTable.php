<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ImovelParcerias Model
 *
 * @property \App\Model\Table\ImoveisTable&\Cake\ORM\Association\BelongsTo $Imoveis
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Parceiros
 *
 * @method \App\Model\Entity\ImovelParceria newEmptyEntity()
 * @method \App\Model\Entity\ImovelParceria newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ImovelParceria> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ImovelParceria get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ImovelParceria findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ImovelParceria patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ImovelParceria> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ImovelParceria|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ImovelParceria saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ImovelParceria>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ImovelParceria>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ImovelParceria>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ImovelParceria> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ImovelParceria>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ImovelParceria>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ImovelParceria>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ImovelParceria> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImovelParceriasTable extends Table
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

        $this->setTable('imovel_parcerias');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Imoveis', [
            'foreignKey' => 'imovei_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Parceiros', [
            'className' => 'Users',
            'foreignKey' => 'parceiro_id',
            'joinType' => 'INNER',
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
            ->nonNegativeInteger('imovei_id')
            ->notEmptyString('imovei_id');

        $validator
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->nonNegativeInteger('parceiro_id')
            ->requirePresence('parceiro_id', 'create')
            ->notEmptyString('parceiro_id');

        $validator
            ->date('inicio_parceria')
            ->allowEmptyDate('inicio_parceria');

        $validator
            ->numeric('porcentagem_parceiro')
            ->greaterThanOrEqual('porcentagem_parceiro', 0)
            ->allowEmptyString('porcentagem_parceiro');

        $validator
            ->date('fim_parceria')
            ->allowEmptyDate('fim_parceria');

        $validator
            ->scalar('situacao')
            ->allowEmptyString('situacao');

        $validator
            ->scalar('observacao_reprovado')
            ->allowEmptyString('observacao_reprovado');

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
        $rules->add($rules->existsIn(['imovei_id'], 'Imoveis'), ['errorField' => 'imovei_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['parceiro_id'], 'Parceiros'), ['errorField' => 'parceiro_id']);

        return $rules;
    }
}
