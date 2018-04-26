<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.01.2018
 * Time: 15:15
 */

namespace app\controllers;


use app\models\Media;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

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
                return $this->redirect(['/media/index']);
            }else{
                vd($model->errors);
            }
        }

        return $this->render('create_foto_album', [
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
                return $this->redirect(['/media/index']);
            }else{
                vd($model-errors);
            }
        }

        return $this->render('create_video_album', [
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

    public function actionCreateFoto($album_id){
        $this->layout = 'clear';
        $album = Media::findOne($album_id);

        $items = UploadedFile::getInstances($album, 'items');

        if(count($items)>0){
            if($album->items == ''){
                $itemsArr = [];
            }else{
                $itemsArr = json_decode($album->items);
            }
            foreach ($items as $k => $item){
                $time = date('YmdHis');
                $itemsArr[] = 'images/photos/'.$album->id . '/' . $time.$k . '.' . $item->extension;
                $dir = \Yii::getAlias('@app');
                $path = $dir.'/web/images/photos/'.$album->id.'/';
                if(!is_dir($path)){
                    mkdir($path);
                }
                $item->saveAs($path .$time.$k . '.' . $item->extension);
            }
            //vd($itemsArr);
            $album->items = json_encode($itemsArr);

            if($album->save()){
                return $this->redirect(['index']);
            }else{
                vd($album->errors);
            }

        }

        return $this->render('create-foto', [
            'album' => $album,
        ]);
    }

    public function actionCreateVideo($album_id){
        $this->layout = 'clear';
        $album = Media::findOne($album_id);

        $post = Yii::$app->request->post();
        //vd($post);
        if(isset($post['Media']['items'])){
            $items = $post['Media']['items'];
            if($album->items == ''){
                $itemsArr = [];
            }else{
                $itemsArr = json_decode($album->items);
            }
            foreach ($items as $item){
                $itemsArr[] = $item;
            }
            $album->items = json_encode($itemsArr);
            if($album->save()){
                return $this->redirect(['index']);
            }else{
                vd($album->errors);
            }


        }

        return $this->render('create-video', [
            'album' => $album,
        ]);
    }


}