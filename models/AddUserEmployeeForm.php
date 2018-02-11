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

    public $name;
    public $fname;
    public $oname;
    public $about;
    public $avatar;
    public $phone;
    public $skype;
    public $birthday;

    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['username', 'email', 'password', 'name', 'fname'], 'required'],
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
        return $user->save() ? $user : null;
    }
}