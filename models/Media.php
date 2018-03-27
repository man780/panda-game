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
 * @property string $items
 * @property int $dcreated
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
            [['name_ru', 'name_en', 'name_th'], 'required'],
            [['description_ru', 'description_en', 'description_th'], 'string'],
            [['foto_video', 'employee_id', 'items', 'created_time'], 'safe'],
            [['name_ru', 'name_en', 'name_th'], 'string', 'max' => 255],
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
            'name_ru' => Yii::t('app', 'Названия Ru'),
            'name_en' => Yii::t('app', 'Названия EN'),
            'name_th' => Yii::t('app', 'Названия TH'),
            'description_ru' => Yii::t('app', 'Описания RU'),
            'description_en' => Yii::t('app', 'Описания EN'),
            'description_th' => Yii::t('app', 'Описания TH'),
            'foto_video' => Yii::t('app', 'Foto Video'),
            'employee_id' => Yii::t('app', 'Сотрудник'),
            'created_time' => Yii::t('app', 'created_time'),
            'items' => Yii::t('app', 'Items'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $cookies = Yii::$app->request->cookies;
            $this->employee_id = $cookies->getValue('employee_id');
            $this->created_time = date('Y-m-d H:i:s', time()+2*3600);
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

    public  function getName(){
        if (\Yii::$app->language=='ru-RU'){
            return $this->name_ru;
        }
        if (\Yii::$app->language=='en-EN'){
            return $this->name_en;
        }
        if (\Yii::$app->language=='th-TH'){
            return $this->name_th;
        }
    }

    public  function getDescription(){
        if (\Yii::$app->language=='ru-RU'){
            return $this->description_ru;
        }
        if (\Yii::$app->language=='en-EN'){
            return $this->description_en;
        }
        if (\Yii::$app->language=='th-TH'){
            return $this->description_th;
        }
    }
}
