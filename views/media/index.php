<?
use yii\bootstrap\Html;
use yii\helpers\Url;
?>
<style>
    .add-album{
        width: 100%;
        height: 100%;
        border: 1px dashed #0099FF;
        text-align: center;
        color: #0099FF;
    }
</style>
<div class="main-container">
    <div class="row">
        <div class="col-md-12">
            <h2><?=$this->title?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <h5>Фотоальбомы</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="add-album">
                            <?= Html::a(Yii::t('app', 'Создать навый фотоальбом'), null,
                                ['class' => '', 'id'=>'createFotoButton',
                                'value'=>Url::toRoute(['/media/create-foto'])]) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item-album">
                            Альбомов нет
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item-album">
                            Альбомов нет
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <h5>Видеоальбомы</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="add-album">

                            <?= Html::a(Yii::t('app', 'Создать навый видеоальбом'), null,
                                ['class' => '', 'id'=>'createVideoButton',
                                    'value'=>Url::toRoute(['/media/create-video'])]) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item-album">
                            Альбомов нет
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item-album">
                            Альбомов нет
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>