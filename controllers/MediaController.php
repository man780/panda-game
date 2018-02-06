<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.01.2018
 * Time: 15:15
 */

namespace app\controllers;


use app\models\Media;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

class MediaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $this->view->title = 'Медиа';
        return $this->render('index');
    }

    public function actionCreateFoto(){
        $this->view->title = 'Медиа';
        $this->layout = false;
        $model = new Media();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->foto_video = 1;
            $model->employee_id = Yii::$app->user->id;
            //vd(Yii::$app->user->id);
            if($model->save()){
                return $this->redirect(['media/index']);
            }else{
                vd($model->errors);
            }
        }

        return $this->renderAjax('_create_foto', [
            'model' => $model,
        ]);
    }

    public function actionCreateVideo(){
        $this->view->title = 'Медиа';
        $this->layout = false;
        $model = new Media();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->foto_video = 2;

            if($model->save()){
                return $this->redirect(['media/index']);
            }else{
                vd($model-errors);
            }
        }

        return $this->renderAjax('_create_video', [
            'model' => $model,
        ]);
    }


}