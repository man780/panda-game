<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_rate".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $rate
 * @property int $current_rate
 * @property int $global_rate
 *
 * @property Employee $employee
 */
class EmployeeRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee_rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'current_rate', 'global_rate'], 'required'],
            [['employee_id', 'rate', 'current_rate', 'global_rate'], 'integer'],
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
            'employee_id' => Yii::t('app', 'Employee ID'),
            'rate' => Yii::t('app', 'Rate'),
            'current_rate' => Yii::t('app', 'Current Rate'),
            'global_rate' => Yii::t('app', 'Global Rate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }
}
