<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class AddUserEmployeeForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $status;

    public $name;
    public $fname;
    public $oname;
    public $about;
    public $avatar;
    public $phone;
    public $skype;
    public $birthday;

    public $verifyCode;
    public $token;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['username', 'email', 'password', 'name', 'fname'], 'required'],
            [['oname', 'about', 'avatar', 'phone', 'skype', 'birthday', 'token'], 'safe'],
            ['username', 'unique',
                'targetClass' => User::className(),
                'message' => 'Это имя уже занято.'],
            // email has to be a valid email address
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'Эта почта уже занята.'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID user',
            'name' => 'Имя',
            'fname' => 'Фамилия',
            'oname' => 'Отчество',
            'about' => 'О себе',
            'avatar' => 'Аватар',
            'phone' => 'Телефон',
            'email' => 'Эл-почта',
            'skype' => 'Скайп',
            'birthday' => 'Дата рождения',
            'team_id' => 'Команда',
            'branch_id' => 'Отдел',
            'position_id' => 'Должность',
            'role_id' => 'Роль',
            'join_date' => 'Время присоединения',
        ];
    }

    public function reg()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if($this->scenario === 'emailActivation')
            $user->generateSecretKey();
//vd($user);
        if($user->save()){
            return $this->addEmployee($user->id);

            //vd($user->errors);
        }else{
            return false;
        }
    }

    public function addEmployee($user_id){
        $employee = new Employee();
        $employee->user_id = $user_id;
        $employee->name = $this->name;
        $employee->fname = $this->fname;
        $employee->oname = $this->oname;
        $employee->email = $this->email;
        $employee->about = $this->about;
        $employee->phone = $this->phone;
        $employee->skype = $this->skype;
        $employee->birthday = $this->birthday;
        $employee->team_id = 1;
        $employee->branch_id = 1;
        $employee->position_id = 1;
        $employee->role_id = 1;
        $employee->join_date = date('Y-m-d H:i:s');
        //vd($employee->attributes);
        if($employee->save()){
            return true;
            //vd($employee->errors);
        }else{
            //vd($employee->errors);
            return false;
        }

    }
}