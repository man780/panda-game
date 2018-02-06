<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "media".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $foto_video
 * @property int $employee_id
 * @property int $created_time
 *
 * @property Employee $employee
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            //[['foto_video', 'employee_id', 'created_time'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Названия'),
            'description' => Yii::t('app', 'Описания'),
            'foto_video' => Yii::t('app', 'Foto Video'),
            'employee_id' => Yii::t('app', 'Сотрудник'),
            'created_time' => Yii::t('app', 'Время создания'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            //$this->employee_id = \Yii::$app->user->id;
            $this->created_time = time();

            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }
}
