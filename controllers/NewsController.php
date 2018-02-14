<?php

namespace app\controllers;

use app\models\News;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class NewsController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = 'Новости';
        $news = News::find()->all();
        return $this->render('index', [
            'news' => $news,
        ]);
    }

    public  function actionCreate(){
        $this->view->title = 'Добавить новость';
        $news = new News();
        if(Yii::$app->request->isAjax && $news->load(Yii::$app->request->post())){
            $news->file = UploadedFile::getInstance($news, 'file');
            $time = date('YmdHis');
            if($news->file){
                $file = $news->file;
                $news->image = 'images/news/' . $file->baseName.'-'.$time . '.' . $file->extension;
            }
            if($news->save()){
                if($news->file){
                    $file = $news->file;
                    $dir = \Yii::getAlias('@app');
                    $file->saveAs($dir.'/web/images/news/' . $file->baseName.'-'.$time . '.' . $file->extension);
                }
                return $this->redirect(['news/index']);
            }else{
                vd($news->errors);
            }
        }

        //vd($news);
        return $this->renderAjax('news_form', [
            'model' => $news,
        ]);
    }
}
