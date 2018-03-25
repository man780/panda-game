<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $image
 * @property string $title
 * @property string $description
 * @property string $full_text
 * @property int $created_user
 * @property string $dcreated
 *
 * @property User $createdUser
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'full_text'], 'required'],
            [['full_text'], 'string'],
            //[['created_user'], 'integer'],
            [['created_time'], 'safe'],
            [['image'], 'file', 'skipOnEmpty' => true,
                'extensions' => ['jpg', 'jpeg', 'png', 'gif']
            ],
            [['title', 'description'], 'string', 'max' => 255],
            [['created_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(),
                'targetAttribute' => ['created_user' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            Yii::$app->session->setFlash('success', 'Запись добавлена!');
            $this->created_user = Yii::$app->user->id;
            $this->created_time = date('Y-m-d H:i:s', time()+2*3600);
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'full_text' => Yii::t('app', 'Full Text'),
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
