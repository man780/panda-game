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
            [['name', 'branch_id', 'file'], 'required'],
            [['branch_id'], 'integer'],
            [['file'], 'file', 'skipOnEmpty' => false,
                'extensions' => ['jpg', 'jpeg', 'png', 'gif']
            ],
            [['name', 'image'], 'string', 'max' => 255],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Наименование'),
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
}
