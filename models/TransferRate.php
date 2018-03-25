<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transfer_rate".
 *
 * @property int $id
 * @property int $from_employee
 * @property int $to_employee
 * @property string $created_time
 *
 * @property Employee $fromEmployee
 * @property Employee $toEmployee
 */
class TransferRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer_rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_employee', 'to_employee', 'rate'], 'required'],
            [['from_employee', 'to_employee', 'rate'], 'integer'],
            [['created_time'], 'safe'],
            [['from_employee'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['from_employee' => 'id']],
            [['to_employee'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['to_employee' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from_employee' => Yii::t('app', 'From Employee'),
            'to_employee' => Yii::t('app', 'To Employee'),
            'created_time' => Yii::t('app', 'Created Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'from_employee']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'to_employee']);
    }
}
