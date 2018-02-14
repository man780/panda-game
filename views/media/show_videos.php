<?
use \yii\helpers\Html;
use yii\helpers\Url;

if(is_null($videoAlbum)):
    echo 'У вас нет доступа к просмотру этого фотоальбома';
    return;
else:?>

    <h2><?=$this->title;?></h2>
    <p class="date"><strong>Дата создяния:</strong> <?=$videoAlbum->dcreated;?></p>
    <p class="description"><strong>Описания: </strong><?=$videoAlbum->description;?></p>
    <div class="container">
        <div class="row">
            <div class="add-album">
                <?= Html::a(Yii::t('app', 'Добавить фото'), null,
                    ['class' => 'create-foto', 'id'=>'createFotoButton',
                        'value'=>Url::toRoute(['/media/create-foto'])]) ?>
            </div>
        </div>
    </div>



<?endif;?>