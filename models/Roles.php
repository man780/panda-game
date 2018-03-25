<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "roles".
 *
 * @property int $id
 * @property string $name
 * @property int $priority
 *
 * @property Employee[] $employees
 */
class Roles extends \yii\db\ActiveRecord
{
    public $priorities = [
        4 => 'Босс',
        1 => 'Руководитель',
        2 => 'Начальник отдела',
        3 => 'Сотрудник',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'priority'], 'required'],
            [['priority'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'priority' => Yii::t('app', 'Priority'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getList()
    {
        return self::find()->where(['>', 'id', 1])->all();
    }

    public function getPriorities($id = null){
        if(is_null($id)){
            return $this->priorities;
        }else{
            //vd($id);
            return $this->priorities[$id];
        }

    }
}
