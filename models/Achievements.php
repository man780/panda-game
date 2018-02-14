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
            [['name', 'reward', 'status_achievement', 'created_user'], 'required'],
            [['description'], 'string'],
            [['reward', 'created_user'], 'integer'],
            [['dcreated'], 'safe'],
            [['name', 'status_achievement', 'image'], 'string', 'max' => 255],
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
            'dcreated' => Yii::t('app', 'Dcreated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_user']);
    }
}
