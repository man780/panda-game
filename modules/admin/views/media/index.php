<?
use yii\bootstrap\Html;
use yii\helpers\Url;
?>

<div class="main-container">
    <div class="row">
        <div class="col-md-12">
            <h2><?=$this->title?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box container">
                <h5>Фотоальбомы</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="add-album">
                            <?= Html::a(Yii::t('app', 'Создать навый фотоальбом'), null,
                                ['class' => 'create-foto-album', 'id'=>'createFotoButton',
                                'value'=>Url::toRoute(['/admin/media/create-foto-album'])]) ?>
                        </div>
                    </div>

                    <? foreach ($fotoAlbums as $fotoAlbum):?>
                    <div class="col-md-4">
                        <div class="item-album">
                            <?=Html::a($fotoAlbum->name, Url::to(['/admin/media/show-fotoes', 'id' => $fotoAlbum->id]));?>
                            <p class="date"><?=$fotoAlbum->created_time?></p>
                        </div>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box container">
                <h5>Видеоальбомы</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="add-album">

                            <?= Html::a(Yii::t('app', 'Создать навый видеоальбом'), null,
                                ['class' => '', 'id'=>'createVideoButton',
                                    'value'=>Url::toRoute(['/admin/media/create-video-album'])]) ?>
                        </div>
                    </div>
                    <?if(count($videoAlbums)>0):?>
                    <? foreach ($videoAlbums as $videoAlbum):?>
                        <div class="col-md-4">
                            <div class="item-album">
                                <?=Html::a($videoAlbum->name, Url::to(['/admin/media/show-videos', 'id' => $videoAlbum->id]));?>
                                <p class="date"><?=$videoAlbum->created_time?></p>
                            </div>
                        </div>
                    <?endforeach;?>
                    <?else:?>
                        <div class="col-md-4">
                            <div class="item-album">
                                Видеоольбомов пока нет
                            </div>
                        </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </div>
</div>