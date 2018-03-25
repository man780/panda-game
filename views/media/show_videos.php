<?
use \yii\helpers\Html;
use yii\helpers\Url;

$items = json_decode($videoAlbum->items);
//vd($items);
if(is_null($videoAlbum)):
    echo 'У вас нет доступа к просмотру этого видеоальбома';
    return;
else:?>

<div class="box">
    <h2><?=$this->title;?></h2>
    <p class="date"><strong>Дата создяния:</strong> <?=$videoAlbum->created_time;?></p>
    <p class="description"><strong>Описания: </strong><?=$videoAlbum->description;?></p>
    <div class="well">
        <div class="row">
            <div class="add-album">
                <?= Html::a(Yii::t('app', 'Добавить видео'), null,
                    ['class' => 'create-foto', 'id'=>'createFotoButton',
                        'value'=>Url::toRoute(['/media/create-video', 'album_id' => $videoAlbum->id])]) ?>
            </div>
        </div>

        <div class="row">
            <?if(!is_null($items)):?>
                <?foreach ($items as $item):?>
                    <div class="col-md-6">
                        <iframe width="560" height="315"
                                src="<?=trim($item)?>"
                                frameborder="0" allow="autoplay; encrypted-media"
                                allowfullscreen></iframe>
                        <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/BghdnGD0P9E"
                                frameborder="0" allow="autoplay; encrypted-media"
                                allowfullscreen></iframe>
                    </div>
                <?endforeach;?>
            <?endif;?>
        </div>
    </div>
</div>
<?endif;?>