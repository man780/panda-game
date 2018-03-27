<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ads".
 *
 * @property int $id
 * @property string $full_text
 * @property int $created_user
 * @property string $created_time
 *
 * @property User $createdUser
 */
class Ads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_text_ru', 'full_text_en', 'full_text_th'], 'string'],
            [['full_text_ru', 'full_text_en', 'full_text_th'], 'required'],
            //[['created_user'], 'integer'],
            [['created_user', 'created_time'], 'safe'],
            [['created_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_user' => 'id']],


            //[[], 'string'],
            //[['full_text_ru', 'full_text_en', 'full_text_th'], 'required'],
            //[['created_user'], 'integer'],
            //[['created_user', 'created_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'full_text_ru' => Yii::t('app', 'Full Text Ru'),
            'full_text_en' => Yii::t('app', 'Full Text En'),
            'full_text_th' => Yii::t('app', 'Full Text Th'),
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
    public function getCreatedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_user']);
    }

    public  function getFull_text(){
        if (\Yii::$app->language=='ru-RU'){
            return $this->full_text_ru;
        }
        if (\Yii::$app->language=='en-EN'){
            return $this->full_text_en;
        }
        if (\Yii::$app->language=='th-TH'){
            return $this->full_text_th;
        }
    }
}
