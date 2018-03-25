<?
use yii\helpers\Html;
use yii\helpers\Url;
use dosamigos\tinymce\TinyMce;
?>

<h2><?=$this->title?></h2>
<div class="box">
    <div class="container">
        <Br>
        <hr>
        <?if(count($newsList)>0):?>
            <div class="row">
                <?foreach ($newsList as $news):?>
                    <div class="col-md-1">
                        <?=Html::img('/'.$news->image, ['height' => '50px']);?>
                    </div>
                    <div class="col-md-5">
                        <a href="<?=Url::to(['news/view', 'id' => $news->id]);?>">
                            <h3><?=$news->title;?></h3>
                        </a>
                        <div><?=$news->description;?></div>
                        <span class="label label-info"><?=$news->created_time;?></span>
                    </div>
                <?endforeach;?>
            </div>
        <?else:?>
            Новостей нет
        <?endif;?>
    </div>

</div>