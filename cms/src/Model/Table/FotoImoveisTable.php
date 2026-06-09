<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FotoImoveis Model
 *
 * @method \App\Model\Entity\FotoImovei newEmptyEntity()
 * @method \App\Model\Entity\FotoImovei newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\FotoImovei> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FotoImovei get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\FotoImovei findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\FotoImovei patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\FotoImovei> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FotoImovei|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\FotoImovei saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\FotoImovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FotoImovei>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\FotoImovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FotoImovei> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\FotoImovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FotoImovei>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\FotoImovei>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FotoImovei> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FotoImoveisTable extends Table
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

        $this->setTable('foto_imoveis');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Imoveis', [
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
            ->nonNegativeInteger('imovel_id')
            ->requirePresence('imovel_id', 'create')
            ->notEmptyString('imovel_id');

        $validator
            ->scalar('arquivo')
            ->maxLength('arquivo', 45)
            ->allowEmptyString('arquivo');

        $validator
            ->allowEmptyString('principal');

        return $validator;
    }
}
