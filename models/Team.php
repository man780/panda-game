<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property string $name
 * @property int $branch_id
 * @property string $image
 * @property int $dcreated
 *
 * @property Employee[] $employees
 * @property Branch $branch
 */
class Team extends \yii\db\ActiveRecord
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
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_ru', 'name_en', 'name_th', 'branch_id'], 'required'],
            [['branch_id'], 'integer'],
            [['file'], 'file', 'skipOnEmpty' => true,
                'extensions' => ['jpg', 'jpeg', 'png', 'gif']
            ],
            [['name_ru', 'name_en', 'name_th', 'image'], 'string', 'max' => 255],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->dcreated = date('Y-m-d H:i:s');
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
            'name_ru' => Yii::t('app', 'Наименование RU'),
            'name_en' => Yii::t('app', 'Наименование EN'),
            'name_th' => Yii::t('app', 'Наименование TH'),
            'branch_id' => Yii::t('app', 'Отдел'),
            'image' => Yii::t('app', 'Картинка'),
            'dcreated' => Yii::t('app', 'Дата создания'),
            'file' => Yii::t('app', 'Картинка (Аватарка)'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getList()
    {
        return self::find()->where(['>', 'id', 1])->all();
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
}
