<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $fname
 * @property string $oname
 * @property string $about
 * @property string $avatar
 * @property string $phone
 * @property string $email
 * @property string $skype
 * @property int $birthday
 * @property int $team_id
 * @property int $branch_id
 * @property int $position_id
 * @property int $role_id
 * @property int $join_date
 *
 * @property Documents[] $documents
 * @property Branch $branch
 * @property Position $position
 * @property Roles $role
 * @property Team $team
 * @property User $user
 * @property EmployeeRate[] $employeeRates
 * @property Execution[] $executions
 * @property Media[] $media
 * @property ProductEmployee[] $productEmployees
 * @property Product[] $products
 * @property Rate[] $rates
 * @property Task[] $tasks
 * @property TaskEmployee[] $taskEmployees
 * @property Task[] $tasks0
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'fname', 'team_id', 'branch_id', 'position_id', 'role_id'], 'required'],
            [['name', 'fname', 'oname', 'about'], 'required', 'on' => 'new-employee'],
            [['user_id', 'team_id', 'branch_id', 'position_id', 'role_id'], 'integer'],
            [['about'], 'string'],
            ['user_id', 'unique',
                'message' => 'Это юзер занято.'],
            [['name', 'fname', 'oname', 'avatar', 'phone', 'email', 'skype'], 'string', 'max' => 255],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['role_id' => 'id']],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['team_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {


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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'fname' => 'Fname',
            'oname' => 'Oname',
            'about' => 'About',
            'avatar' => 'Avatar',
            'phone' => 'Phone',
            'email' => 'Email',
            'skype' => 'Skype',
            'birthday' => 'Birthday',
            'team_id' => 'Team ID',
            'branch_id' => 'Branch ID',
            'position_id' => 'Position ID',
            'role_id' => 'Role ID',
            'join_date' => 'Join Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['employee_id' => 'id']);
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
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeRates()
    {
        return $this->hasMany(EmployeeRate::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutions()
    {
        return $this->hasMany(Execution::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductEmployees()
    {
        return $this->hasMany(ProductEmployee::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('product_employee', ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRates()
    {
        return $this->hasMany(Rate::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['created_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskEmployees()
    {
        return $this->hasMany(TaskEmployee::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Task::className(), ['id' => 'task_id'])->viaTable('task_employee', ['employee_id' => 'id']);
    }
}
