<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Atendimentos Model
 *
 * @property \App\Model\Table\PessoasTable&\Cake\ORM\Association\BelongsTo $Pessoas
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ImoveisTable&\Cake\ORM\Association\BelongsTo $Imoveis
 *
 * @method \App\Model\Entity\Atendimento newEmptyEntity()
 * @method \App\Model\Entity\Atendimento newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Atendimento> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Atendimento get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Atendimento findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Atendimento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Atendimento> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Atendimento|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Atendimento saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Atendimento>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Atendimento>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Atendimento>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Atendimento> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Atendimento>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Atendimento>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Atendimento>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Atendimento> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AtendimentosTable extends Table
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

        $this->setTable('atendimentos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Pessoas', [
            'foreignKey' => 'pessoa_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'atendido_por',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('Imoveis', [
            'foreignKey' => 'imovel_id',
            'joinType' => 'LEFT',
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
            ->nonNegativeInteger('pessoa_id')
            ->notEmptyString('pessoa_id');

        $validator
            ->nonNegativeInteger('imovel_id')
            ->allowEmptyString('imovel_id');

        $validator
            ->boolean('interesse')
            ->allowEmptyString('interesse');

        $validator
            ->nonNegativeInteger('atendido_por')
            ->allowEmptyString('atendido_por');

        $validator
            ->scalar('canal')
            ->allowEmptyString('canal');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

        $validator
            ->scalar('conversao')
            ->allowEmptyString('conversao');

        $validator
            ->integer('nota')
            ->allowEmptyString('nota');

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
        $rules->add($rules->existsIn(['pessoa_id'], 'Pessoas'), ['errorField' => 'pessoa_id']);

        return $rules;
    }
}
