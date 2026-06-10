<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pessoas Model
 *
 * @property \App\Model\Table\AtendimentosTable&\Cake\ORM\Association\HasMany $Atendimentos
 *
 * @method \App\Model\Entity\Pessoa newEmptyEntity()
 * @method \App\Model\Entity\Pessoa newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Pessoa> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pessoa get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Pessoa findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Pessoa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Pessoa> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pessoa|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Pessoa saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Pessoa>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Pessoa>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Pessoa>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Pessoa> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Pessoa>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Pessoa>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Pessoa>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Pessoa> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PessoasTable extends Table
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

        $this->setTable('pessoas');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Atendimentos', [
            'foreignKey' => 'pessoa_id',
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
            ->scalar('cpf')
            ->maxLength('cpf', 15)
            ->allowEmptyString('cpf');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 200)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->date('nascimento')
            ->allowEmptyDate('nascimento');

        $validator
            ->scalar('mae')
            ->maxLength('mae', 200)
            ->allowEmptyString('mae');

        $validator
            ->scalar('pai')
            ->maxLength('pai', 200)
            ->allowEmptyString('pai');

        $validator
            ->scalar('sexo')
            ->allowEmptyString('sexo');

        $validator
            ->nonNegativeInteger('raca_id')
            ->allowEmptyString('raca_id');

        $validator
            ->scalar('estado_civil')
            ->maxLength('estado_civil', 1)
            ->allowEmptyString('estado_civil');

        $validator
            ->scalar('nome_social')
            ->maxLength('nome_social', 150)
            ->allowEmptyString('nome_social');

        $validator
            ->nonNegativeInteger('escolaridade_id')
            ->allowEmptyString('escolaridade_id');

        $validator
            ->nonNegativeInteger('renda_id')
            ->allowEmptyString('renda_id');

        $validator
            ->nonNegativeInteger('religiao_id')
            ->allowEmptyString('religiao_id');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('cep')
            ->maxLength('cep', 10)
            ->allowEmptyString('cep');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 10)
            ->allowEmptyString('numero');

        $validator
            ->scalar('complemento')
            ->maxLength('complemento', 150)
            ->allowEmptyString('complemento');

        $validator
            ->decimal('latitude')
            ->allowEmptyString('latitude');

        $validator
            ->decimal('longitude')
            ->allowEmptyString('longitude');

        $validator
            ->scalar('telefone')
            ->maxLength('telefone', 45)
            ->allowEmptyString('telefone');

        $validator
            ->scalar('whatsapp')
            ->maxLength('whatsapp', 45)
            ->allowEmptyString('whatsapp');

        $validator
            ->scalar('telegram')
            ->maxLength('telegram', 45)
            ->allowEmptyString('telegram');

        $validator
            ->scalar('facebook')
            ->maxLength('facebook', 100)
            ->allowEmptyString('facebook');

        $validator
            ->scalar('instagram')
            ->maxLength('instagram', 100)
            ->allowEmptyString('instagram');

        $validator
            ->scalar('foto')
            ->maxLength('foto', 4294967295)
            ->allowEmptyString('foto');

        $validator
            ->boolean('propaganda')
            ->allowEmptyString('propaganda');

        $validator
            ->boolean('share_data')
            ->allowEmptyString('share_data');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

        $validator
            ->scalar('origem')
            ->allowEmptyString('origem');

        $validator
            ->scalar('id_asaas')
            ->maxLength('id_asaas', 45)
            ->allowEmptyString('id_asaas');

        $validator
            ->scalar('motivo')
            ->allowEmptyString('motivo');

        return $validator;
    }
}
