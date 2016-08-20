<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Songs Model
 *
 * @method \App\Model\Entity\Song get($primaryKey, $options = [])
 * @method \App\Model\Entity\Song newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Song[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Song|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Song patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Song[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Song findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SongsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('songs');
        $this->displayField('Id');
        $this->primaryKey('Id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('Id')
            ->allowEmpty('Id', 'create');

        $validator
            ->integer('User_Id')
            ->requirePresence('User_Id', 'create')
            ->notEmpty('User_Id');

        $validator
            ->allowEmpty('Album');

        $validator
            ->allowEmpty('Artist');

        $validator
            ->allowEmpty('BitRate');

        $validator
            ->allowEmpty('Composer');

        $validator
            ->allowEmpty('Genre');

        $validator
            ->allowEmpty('Kind');

        $validator
            ->allowEmpty('Name');

        $validator
            ->integer('PlayCount')
            ->allowEmpty('PlayCount');

        $validator
            ->dateTime('PlayDateUTC')
            ->allowEmpty('PlayDateUTC');

        $validator
            ->integer('Rating')
            ->allowEmpty('Rating');

        $validator
            ->allowEmpty('SampleRate');

        $validator
            ->integer('Size')
            ->allowEmpty('Size');

        $validator
            ->integer('SkipCount')
            ->allowEmpty('SkipCount');

        $validator
            ->allowEmpty('TotalTime');

        $validator
            ->allowEmpty('TrackID');

        $validator
            ->integer('Year')
            ->allowEmpty('Year');

        return $validator;
    }
}
