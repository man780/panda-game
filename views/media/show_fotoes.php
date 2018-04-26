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
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 2000; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */

    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content, #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)}
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
        z-index: 9999999;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
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
            <?if(!is_null($items)):?>
            <?foreach ($items as $item):?>
            <div class="col-md-2">
                <div class="container">

                    <?//=Html::img('/'.$item, ['class' => ' modal-content', 'id' => 'img01']);?>
                    <img id="myImg" class="myImg" src="<?='/'.$item?>" width="100%" />

                </div>

            </div>
            <?endforeach;?>
            <?endif;?>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="close">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementsByClassName('myImg')[0];
        //console.log(img);
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        };

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
</div>
<?endif;?>