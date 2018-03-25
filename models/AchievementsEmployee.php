<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "achievements_employee".
 *
 * @property int $achievement_id
 * @property int $employee_id
 * @property int $created_at
 *
 * @property Employee $employee
 * @property Achievements $achievement
 */
class AchievementsEmployee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'achievements_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['achievement_id', 'employee_id'], 'required'],
            [['achievement_id', 'employee_id'], 'integer'],
            [['achievement_id', 'employee_id'], 'unique', 'targetAttribute' => ['achievement_id', 'employee_id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['achievement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Achievements::className(), 'targetAttribute' => ['achievement_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'achievement_id' => Yii::t('app', 'Achievement ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Достижения присвоены!');
                $this->created_at = date('Y-m-d H:i:s');
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
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAchievement()
    {
        return $this->hasOne(Achievements::className(), ['id' => 'achievement_id']);
    }

    public function setRate($employee_id, $achievement_id){
        $employeeRate = EmployeeRate::find()->where(['employee_id' => $employee_id])->one();
        $achievementModel = Achievements::findOne($achievement_id);
        //vd($employeeRate);
        if(is_null($employeeRate)){
            $employeeRate = new EmployeeRate();
            $employeeRate->current_rate = $achievementModel->reward;
            $employeeRate->global_rate = $achievementModel->reward;
            $employeeRate->rate = $achievementModel->reward;
        }else{
            $employeeRate->current_rate = $employeeRate->current_rate+$achievementModel->reward;
            $employeeRate->global_rate = $employeeRate->global_rate+$achievementModel->reward;
            $employeeRate->rate = $achievementModel->reward;
        }
        if(!$employeeRate->save()){
            vd($employeeRate->errors);
        }
    }
}
