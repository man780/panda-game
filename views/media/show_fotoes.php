<?
use \yii\helpers\Html;
use yii\helpers\Url;


if(is_null($fotoAlbum)):
    echo 'У вас нет доступа к просмотру этого фотоальбома';
    return;
else:?>

    <h2><?=$this->title;?></h2>
    <p class="date"><strong>Дата создяния:</strong> <?=$fotoAlbum->dcreated;?></p>
    <p class="description"><strong>Описания: </strong><?=$fotoAlbum->description;?></p>
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