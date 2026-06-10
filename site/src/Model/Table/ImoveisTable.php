<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Imoveis Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CategoriasTable&\Cake\ORM\Association\BelongsTo $Categorias
 *
 * @method \App\Model\Entity\Imovei newEmptyEntity()
 * @method \App\Model\Entity\Imovei newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Imovei> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Imovei get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Imovei findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Imovei patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Imovei> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Imovei|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Imovei saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Imovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Imovei>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Imovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Imovei> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Imovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Imovei>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Imovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Imovei> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImoveisTable extends Table
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

        $this->setTable('imoveis');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Categorias', [
            'foreignKey' => 'categoria_id',
        ]);
        $this->belongsTo('Pessoas', [
            'foreignKey' => 'proprietario',
        ]);
        $this->belongsTo('TipoImoveis', [
            'foreignKey' => 'tipo_imovel_id',
        ]);
        $this->hasMany('FotoImoveis', [
            'foreignKey' => 'imovel_id',
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
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->nonNegativeInteger('proprietario')
            ->requirePresence('proprietario', 'create')
            ->notEmptyString('proprietario');

        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 45)
            ->allowEmptyString('titulo');

        $validator
            ->scalar('chamada')
            ->maxLength('chamada', 120)
            ->allowEmptyString('chamada');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

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
            ->nonNegativeInteger('vaga_garagem')
            ->allowEmptyString('vaga_garagem');

        $validator
            ->integer('banheiros')
            ->allowEmptyString('banheiros');

        $validator
            ->integer('tamanho')
            ->allowEmptyString('tamanho');

        $validator
            ->integer('quartos')
            ->allowEmptyString('quartos');

        $validator
            ->scalar('foto')
            ->maxLength('foto', 45)
            ->allowEmptyString('foto');

        $validator
            ->nonNegativeInteger('tipo_imovel_id')
            ->allowEmptyString('tipo_imovel_id');

        $validator
            ->scalar('construtora')
            ->maxLength('construtora', 100)
            ->allowEmptyString('construtora');

        $validator
            ->scalar('negocio')
            ->allowEmptyString('negocio');

        $validator
            ->nonNegativeInteger('categoria_id')
            ->allowEmptyString('categoria_id');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

        $validator
            ->scalar('situacao')
            ->allowEmptyString('situacao');

        $validator
            ->numeric('valor')
            ->greaterThanOrEqual('valor', 0)
            ->allowEmptyString('valor');

        $validator
            ->numeric('iptu')
            ->greaterThanOrEqual('iptu', 0)
            ->allowEmptyString('iptu');

        $validator
            ->numeric('comissao')
            ->greaterThanOrEqual('comissao', 0)
            ->allowEmptyString('comissao');

        $validator
            ->allowEmptyString('show_site');

        $validator
            ->allowEmptyString('show_preco_site');

        $validator
            ->allowEmptyString('comissao_permanente');

        $validator
            ->scalar('tipo_comissao')
            ->allowEmptyString('tipo_comissao');

        $validator
            ->allowEmptyString('financia');

        $validator
            ->allowEmptyString('corretor_opcionista');

        $validator
            ->allowEmptyString('exclusividade');

        $validator
            ->date('inicio_exclusividade')
            ->allowEmptyDate('inicio_exclusividade');

        $validator
            ->date('fim_exclusividade')
            ->allowEmptyDate('fim_exclusividade');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['categoria_id'], 'Categorias'), ['errorField' => 'categoria_id']);

        return $rules;
    }
}
