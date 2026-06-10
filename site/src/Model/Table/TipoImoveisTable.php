<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoImoveis Model
 *
 * @method \App\Model\Entity\TipoImovei newEmptyEntity()
 * @method \App\Model\Entity\TipoImovei newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\TipoImovei> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoImovei get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\TipoImovei findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\TipoImovei patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\TipoImovei> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoImovei|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\TipoImovei saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\TipoImovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoImovei>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TipoImovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoImovei> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TipoImovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoImovei>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TipoImovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoImovei> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TipoImoveisTable extends Table
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

        $this->setTable('tipo_imoveis');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');
        
        $this->hasMany('Imoveis', [
            'foreignKey' => 'tipo_imovel_id',
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
            ->allowEmptyString('nome');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

        return $validator;
    }
}
