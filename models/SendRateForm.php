<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 02.05.2015
 * Time: 18:16
 */
namespace app\models;

use yii\base\Model;

class SendRateForm extends Model
{
    public $rate;
    public $to_employee;
    public $from_employee;

    public function rules()
    {
        return [
            [['rate', 'to_employee', 'from_employee'], 'required'],
            //[['email', 'password'], 'required', 'on' => 'loginWithEmail'],
            //['email', 'email'],
            //['rememberMe', 'boolean'],
            //['password', 'validatePassword']
        ];
    }

    public function attributeLabels()
    {
        return [
            'rate' => 'Бал',
            'to_employee' => 'От',
            'from_employee' => 'К',
        ];
    }


}