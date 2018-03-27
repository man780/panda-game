<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "branch".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $dcreated
 *
 * @property Employee[] $employees
 * @property Position[] $positions
 * @property Team[] $teams
 */
class Branch extends \yii\db\ActiveRecord
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
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_ru', 'name_en', 'name_th'], 'required'],
            //[['dcreated'], 'integer'],
            [['file'], 'file', 'skipOnEmpty' => true,
                'extensions' => ['jpg', 'jpeg', 'png', 'gif']
            ],
            [['name_ru', 'name_en', 'name_th'], 'string', 'max' => 255],
            [['dcreated'], 'safe'],

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
            'image' => Yii::t('app', 'Image'),
            'dcreated' => Yii::t('app', 'Dcreated'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPositions()
    {
        return $this->hasMany(Position::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Team::className(), ['branch_id' => 'id']);
    }

    public function getBranchesAll()
    {
        return ArrayHelper::map(Branch::find()->where(['>', 'id', 2])->asArray()->all(), 'id', 'name_ru');
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
