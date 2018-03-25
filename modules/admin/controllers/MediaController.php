<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.01.2018
 * Time: 15:15
 */

namespace app\modules\admin\controllers;


use app\models\Media;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
        $cookies = \Yii::$app->request->cookies;
        $employee_id = $cookies['employee_id']->value;
        $fotoAlbums = Media::find()->where(['foto_video' => 1, 'employee_id' => $employee_id])->all();
        $videoAlbums= Media::find()->where(['foto_video' => 2, 'employee_id' => $employee_id])->all();
        return $this->render('index', [
            'fotoAlbums' => $fotoAlbums,
            'videoAlbums' => $videoAlbums,
        ]);
    }

    public function actionCreateFotoAlbum(){
        $this->view->title = 'Добавить фотоальбом';
        $this->layout = false;
        $model = new Media();


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->foto_video = 1;
            $cookies = \Yii::$app->request->cookies;
            $employee_id = $cookies['employee_id']->value;
            $model->employee_id = $employee_id;
            if($model->save()){
                return $this->redirect(['media/index']);
            }else{
                vd($model->errors);
            }
        }

        return $this->render('_create_foto', [
            'model' => $model,
        ]);
    }

    public function actionCreateVideoAlbum(){
        $this->view->title = 'Добавить видеоальбом';
        $this->layout = false;
        $model = new Media();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->foto_video = 2;
            $cookies = \Yii::$app->request->cookies;
            $employee_id = $cookies['employee_id']->value;
            $model->employee_id = $employee_id;
            if($model->save()){
                return $this->redirect(['media/index']);
            }else{
                vd($model-errors);
            }
        }

        return $this->render('_create_video', [
            'model' => $model,
        ]);
    }

    public function actionShowFotoes($id){
        $cookies = \Yii::$app->request->cookies;
        $employee_id = $cookies['employee_id']->value;
        $fotoAlbum = Media::find()->where(['employee_id' => $employee_id, 'id' => $id])->one();
        $this->view->title = 'Просмотр фотоальбома: '.$fotoAlbum->name;
        return $this->render('show_fotoes', [
            'fotoAlbum' => $fotoAlbum,
        ]);
    }

    public function actionShowVideos($id){
        $cookies = \Yii::$app->request->cookies;
        $employee_id = $cookies['employee_id']->value;
        $videoAlbum = Media::find()->where(['employee_id' => $employee_id, 'id' => $id])->one();
        $this->view->title = 'Просмотр видеоальбома: '.$videoAlbum->name;
        return $this->render('show_videos', [
            'videoAlbum' => $videoAlbum,
        ]);
    }


}