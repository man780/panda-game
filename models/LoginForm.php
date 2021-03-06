<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 02.05.2015
 * Time: 18:16
 */
namespace app\models;

use yii\base\Model;
use Yii;
use yii\web\Cookie;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $rememberMe = true;
    public $status;

    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required', 'on' => 'default'],
            [['email', 'password'], 'required', 'on' => 'loginWithEmail'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()):
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)):
                $field = ($this->scenario === 'loginWithEmail') ? 'email' : 'username';
                $this->addError($attribute, 'Неправильный '.$field.' или пароль.');
            endif;
        endif;
    }

    public function getUser()
    {
        if ($this->_user === false):
            if($this->scenario === 'loginWithEmail'):
                $this->_user = User::findByEmail($this->email);
            else:
                $this->_user = User::findByUsername($this->username);
            endif;
        endif;
        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Ник',
            'email' => 'Емайл',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }

    public function login()
    {
        //vd($this);
        if ($this->validate()):

            $this->status = ($user = $this->getUser()) ? $user->status : User::STATUS_NOT_ACTIVE;
            //vd([$this->status , User::STATUS_ACTIVE, $this]);
            if ($this->status === User::STATUS_ACTIVE):

                $cookie = new Cookie([
                    'name' => 'employee_id',
                    'value' => $user->employee->id,
                    'expire' => time() + 3600*24*30,
                ]);
                \Yii::$app->getResponse()->getCookies()->add($cookie);
                //$cookies = Yii::$app->request->cookies;
                //$cookies->getValue('employee_id', $user->employee->id);
                //vd($user->employee->id);

                return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }
}