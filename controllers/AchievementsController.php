<?php

namespace app\controllers;

use app\models\Employee;
use Yii;
use app\models\Achievements;
use app\models\AchievementsSerach;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AchievementsController implements the CRUD actions for Achievements model.
 */
class AchievementsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Achievements models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->title = 'Достижения';
        $cookies = Yii::$app->request->cookies;
        $employee_id = $cookies->getValue('employee_id');
        $employee = Employee::findOne($employee_id);
        //$user = Yii::$app->user->identity;
        //vd($user);
        //$myProductList = $employee->products;
        $achievements = $employee->achievements;
        //vd($achievements);
        return $this->render('index', [
            'achievements' => $achievements,
        ]);
    }

    /**
     * Displays a single Achievements model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Finds the Achievements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Achievements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Achievements::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
