<?
use yii\helpers\Html;
use yii\helpers\Url;
use dosamigos\tinymce\TinyMce;
?>

<h2><?=$this->title?></h2>
<div class="box">
    <div class="container">
        <Br>
        <?= Html::a(Yii::t('app', 'Добавить новость'), null, ['class' => 'btn btn-primary openModalForm',
            'value'=>Url::toRoute(['/admin/news/create'])]) ?>
        <hr>
        <?if(count($newsList)>0):?>
            <?foreach ($newsList as $news):?>
                <div class="row">
                    <div class="col-md-1">
                        <?=Html::img('/'.$news->image, ['height' => '50px']);?>
                    </div>
                    <div class="col-md-9">
                        <p><?=$news->title;?></p>
                        <p><?=$news->full_text;?></p>
                        <p><?=$news->description;?></p>
                        <p><?=$news->created_time;?></p>
                    </div>
                    <div class="col-md-2">
                        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', null, [
                            'class' => 'openModalForm',
                            'value' => Url::toRoute(['/admin/news/update', 'id' => $news->id])
                        ]);
                        ?>
                        <?=Html::a('<i class="glyphicon glyphicon-trash"></i>',
                            Url::to(['/admin/news/delete', 'id' => $news->id]),
                            ['data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ]]
                        );?>
                    </div>
                </div>
                <hr>
            <?endforeach;?>
        <?else:?>
            Новостей нет
        <?endif;?>
    </div>

</div>