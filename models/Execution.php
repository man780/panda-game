<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "execution".
 *
 * @property int $id
 * @property int $task_id
 * @property int $employee_id
 * @property string $execution_time
 * @property string $text
 * @property string $file
 * @property int $is_executed
 * @property int $accepted_user
 *
 * @property User $acceptedUser
 * @property Employee $employee
 * @property Task $task
 */
class Execution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'execution';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'employee_id'], 'required'],
            [['task_id', 'employee_id', 'is_executed', 'accepted_user'], 'integer'],
            [['execution_time'], 'safe'],
            [['text'], 'string'],
            [['file'], 'string', 'max' => 255],
            [['accepted_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['accepted_user' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'task_id' => Yii::t('app', 'Task ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'execution_time' => Yii::t('app', 'Execution Time'),
            'text' => Yii::t('app', 'Text'),
            'file' => Yii::t('app', 'File'),
            'is_executed' => Yii::t('app', 'Is Executed'),
            'accepted_user' => Yii::t('app', 'Accepted User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcceptedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'accepted_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
