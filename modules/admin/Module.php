<?php

namespace app\modules\admin;

use Yii;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function beforeAction($action){

        if (!parent::beforeAction($action)) {
            return false;
        }
        if($action->id == 'confirm-email' || $action->id == 'add-user-employee'){
            return true;
        }
        if (Yii::$app->user->id == 1){
            return true;
        } else {
            Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
            //для перестраховки вернем false
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout = 'admin';
        // custom initialization code goes here
    }
}
