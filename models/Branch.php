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

            [['name'], 'required'],
            //[['dcreated'], 'integer'],
            [['file'], 'file', 'skipOnEmpty' => false,
                'extensions' => ['jpg', 'jpeg', 'png', 'gif']
            ],
            [['name'], 'string', 'max' => 255],

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
            'id' => Yii::t('app', '№'),
            'name' => Yii::t('app', 'Наименование'),
            'image' => Yii::t('app', 'Картинка'),
            'dcreated' => Yii::t('app', 'Время добавления'),
            'file' => Yii::t('app', 'Картинка (Аватарка)'),
        ];
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
        return ArrayHelper::map(Branch::find()->asArray()->all(), 'id', 'name');
    }
}
