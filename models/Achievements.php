<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "achievements".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $reward
 * @property string $status_achievement
 * @property string $image
 * @property int $created_user
 * @property string $dcreated
 *
 * @property User $createdUser
 */
class Achievements extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'achievements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_ru', 'name_en', 'name_th', 'reward', 'status_achievement'], 'required'],
            [['description_ru', 'description_en', 'description_th', ], 'string'],
            [['reward'], 'integer'],
            [['dcreated', 'image'], 'safe'],
            [['image'], 'file', 'skipOnEmpty' => true,
                'extensions' => ['jpg', 'jpeg', 'png', 'gif']
            ],
            [['name', 'status_achievement'], 'string', 'max' => 255],
            [['created_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_user' => 'id']],

            //[[, 'reward', 'status_achievement'], 'required'],
            //[['description_ru', 'description_en', 'description_th'], 'string'],
            //[['reward'], 'integer'],
            //[['dcreated'], 'safe'],
            //[['name_ru', 'name_en', 'name_th', 'status_achievement', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_ru' => Yii::t('app', 'Name Ru'),
            'name_en' => Yii::t('app', 'Name En'),
            'name_th' => Yii::t('app', 'Name Th'),
            'description_ru' => Yii::t('app', 'Description Ru'),
            'description_en' => Yii::t('app', 'Description En'),
            'description_th' => Yii::t('app', 'Description Th'),
            'reward' => Yii::t('app', 'Reward'),
            'status_achievement' => Yii::t('app', 'Status Achievement'),
            'image' => Yii::t('app', 'Image'),
            'created_user' => Yii::t('app', 'Created User'),
            'dcreated' => Yii::t('app', 'Dcreated'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_user = Yii::$app->user->id;
                $this->dcreated = date('Y-m-d H:i:s');
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
