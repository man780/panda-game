<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invite".
 *
 * @property int $id
 * @property string $fio
 * @property string $email
 * @property string $date_begin
 * @property int $dcreated
 */
class Invite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dcreated'], 'integer'],
            [['fio', 'email', 'date_begin'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fio' => Yii::t('app', 'Fio'),
            'email' => Yii::t('app', 'Email'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'dcreated' => Yii::t('app', 'Dcreated'),
        ];
    }

    public function send(){
        return Yii::$app->mailer->compose('resetPassword', ['user' => $this->fio])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name.' (отправлено роботом)'])
            ->setTo($this->email)
            ->setSubject('Сброс пароля для '.Yii::$app->name)
            ->send();
        //vd($this->attributes); die;
    }
}
