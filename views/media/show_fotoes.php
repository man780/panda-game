<?
use yii\helpers\Html;
use yii\helpers\Url;

$items = json_decode($fotoAlbum->items);
//vd(is_null($items));
if(is_null($fotoAlbum)):
    echo 'У вас нет доступа к просмотру этого фотоальбома';
    return;
else:?>

<style>
    .row {
        display: -ms-flexbox; /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap; /* IE10 */
        flex-wrap: wrap;
        padding: 0 4px;
    }

    /* Create four equal columns that sits next to each other */
    .column {
        -ms-flex: 25%; /* IE10 */
        flex: 25%;
        max-width: 25%;
        padding: 0 4px;
    }

    .column img {
        margin-top: 8px;
        vertical-align: middle;
    }

    /* Responsive layout - makes a two column-layout instead of four columns */
    @media screen and (max-width: 800px) {
        .column {
            -ms-flex: 50%;
            flex: 50%;
            max-width: 50%;
        }
    }

    /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
        .column {
            -ms-flex: 100%;
            flex: 100%;
            max-width: 100%;
        }
    }
</style>
<div class="box">


    <h2><?=$this->title;?></h2>
    <p class="date"><strong>Дата создяния:</strong> <?=$fotoAlbum->created_time;?></p>
    <p class="description"><strong>Описания: </strong><?=$fotoAlbum->description;?></p>
    <div class="well">
        <div class="row">
            <div class="add-album">
                <?= Html::a(Yii::t('app', 'Добавить фото'), null,
                    [
                        'class' => 'updateBranchButton',
                        'value'=>Url::toRoute(['/media/create-foto', 'album_id' => $fotoAlbum->id])
                    ]
                )
                ?>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <img src="/images/photos/1/wedding.jpg" style="width:100%">
                <img src="/images/photos/1/rocks.jpg" style="width:100%">
                <img src="/images/photos/1/falls2.jpg" style="width:100%">
                <img src="/images/photos/1/paris.jpg" style="width:100%">
                <img src="/images/photos/1/nature.jpg" style="width:100%">
                <img src="/images/photos/1/mist.jpg" style="width:100%">
                <img src="/images/photos/1/paris.jpg" style="width:100%">
            </div>
            <div class="column">
                <img src="/images/photos/1/underwater.jpg" style="width:100%">
                <img src="/images/photos/1/ocean.jpg" style="width:100%">
                <img src="/images/photos/1/wedding.jpg" style="width:100%">
                <img src="/images/photos/1/mountainskies.jpg" style="width:100%">
                <img src="/images/photos/1/rocks.jpg" style="width:100%">
                <img src="/images/photos/1/underwater.jpg" style="width:100%">
            </div>
            <div class="column">
                <img src="/images/photos/1/wedding.jpg" style="width:100%">
                <img src="/images/photos/1/rocks.jpg" style="width:100%">
                <img src="/images/photos/1/falls2.jpg" style="width:100%">
                <img src="/images/photos/1/paris.jpg" style="width:100%">
                <img src="/images/photos/1/nature.jpg" style="width:100%">
                <img src="/images/photos/1/mist.jpg" style="width:100%">
                <img src="/images/photos/1/paris.jpg" style="width:100%">
            </div>
            <div class="column">
                <img src="/images/photos/1/underwater.jpg" style="width:100%">
                <img src="/images/photos/1/ocean.jpg" style="width:100%">
                <img src="/images/photos/1/wedding.jpg" style="width:100%">
                <img src="/images/photos/1/mountainskies.jpg" style="width:100%">
                <img src="/images/photos/1/rocks.jpg" style="width:100%">
                <img src="/images/photos/1/underwater.jpg" style="width:100%">
            </div>
        </div>

        <div class="row">
            <?if(!is_null($items)):?>
            <?foreach ($items as $item):?>
            <div class="col-md-2">
                <?=Html::img('/'.$item, ['style' => ['height' => '70px']]);?>
            </div>
            <?endforeach;?>
            <?endif;?>
        </div>
    </div>

</div>
<?endif;?>