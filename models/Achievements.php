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
            [['name', 'reward', 'status_achievement'], 'required'],
            [['description'], 'string'],
            [['reward', 'created_user'], 'integer'],
            [['dcreated', 'image'], 'safe'],
            [['image'], 'file', 'skipOnEmpty' => true,
                'extensions' => ['jpg', 'jpeg', 'png', 'gif']
            ],
            [['name', 'status_achievement'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'reward' => Yii::t('app', 'Reward'),
            'status_achievement' => Yii::t('app', 'Status Achievement'),
            'image' => Yii::t('app', 'Image'),
            'created_user' => Yii::t('app', 'Created User'),
            'created_time' => Yii::t('app', 'Dcreated'),
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
}
