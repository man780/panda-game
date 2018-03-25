<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_employee".
 *
 * @property int $task_id
 * @property int $employee_id
 * @property int $created_at
 * @property int $status
 *
 * @property Employee $employee
 * @property Task $task
 */
class TaskEmployee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'employee_id'], 'required'],
            [['task_id', 'employee_id', 'created_at', 'status'], 'integer'],
            [['task_id', 'employee_id'], 'unique', 'targetAttribute' => ['task_id', 'employee_id']],
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
            'task_id' => Yii::t('app', 'Task ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
        ];
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
