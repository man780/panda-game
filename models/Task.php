<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $text
 * @property string $deadline
 * @property int $reward
 * @property int $created_user
 * @property string $created_time
 *
 * @property Execution[] $executions
 * @property Rate[] $rates
 * @property User $createdUser
 * @property TaskEmployee[] $taskEmployees
 * @property Employee[] $employees
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text_ru', 'text_en', 'text_th', 'reward', 'deadline'], 'required'],
            [['text_ru', 'text_en', 'text_th'], 'string'],
            [['deadline', 'created_time'], 'safe'],
            [['reward', 'created_user'], 'integer'],
            [['created_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'text_ru' => Yii::t('app', 'Text RU'),
            'text_en' => Yii::t('app', 'Text EN'),
            'text_th' => Yii::t('app', 'Text TH'),
            'deadline' => Yii::t('app', 'Deadline'),
            'reward' => Yii::t('app', 'Reward'),
            'created_user' => Yii::t('app', 'Created User'),
            'created_time' => Yii::t('app', 'Created Time'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_user = Yii::$app->user->id;
                $this->created_time = date('Y-m-d H:i:s');

                Yii::$app->session->setFlash('success', 'Запись добавлена!');
            } else {
                Yii::$app->session->setFlash('success', 'Запись обновлена!');
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutions()
    {
        return $this->hasMany(Execution::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRates()
    {
        return $this->hasMany(Rate::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskEmployees()
    {
        return $this->hasMany(TaskEmployee::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['id' => 'employee_id'])->viaTable('task_employee', ['task_id' => 'id']);
    }

    public  function getText(){
        if (\Yii::$app->language=='ru-RU'){
            return $this->text_ru;
        }
        if (\Yii::$app->language=='en-EN'){
            return $this->text_en;
        }
        if (\Yii::$app->language=='th-TH'){
            return $this->text_th;
        }
    }
}
