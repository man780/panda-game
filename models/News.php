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
            [['title_ru', 'title_en', 'title_th', 'full_text_ru', 'full_text_en', 'full_text_th'], 'required'],
            [['full_text_ru', 'full_text_en', 'full_text_th'], 'string'],
            //[['created_user'], 'integer'],
            [['created_time'], 'safe'],
            [['image'], 'file', 'skipOnEmpty' => true,
                'extensions' => ['jpg', 'jpeg', 'png', 'gif']
            ],
            [['title_ru', 'title_en', 'title_th', 'description_ru', 'description_en', 'description_th'], 'string', 'max' => 255],
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
            'title_ru' => Yii::t('app', 'Title RU'),
            'title_en' => Yii::t('app', 'Title EN'),
            'title_th' => Yii::t('app', 'Title TH'),
            'description_ru' => Yii::t('app', 'Description RU'),
            'description_en' => Yii::t('app', 'Description EN'),
            'description_th' => Yii::t('app', 'Description TH'),
            'full_text_ru' => Yii::t('app', 'Full Text RU'),
            'full_text_en' => Yii::t('app', 'Full Text EN'),
            'full_text_th' => Yii::t('app', 'Full Text TH'),
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

    public  function getTitle(){
        if (\Yii::$app->language=='ru-RU'){
            return $this->title_ru;
        }
        if (\Yii::$app->language=='en-EN'){
            return $this->title_en;
        }
        if (\Yii::$app->language=='th-TH'){
            return $this->title_th;
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
