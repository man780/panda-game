<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this \yii\web\View */
/* @var $content string */
use app\widgets\WLang;

if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it.
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        app\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>

        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?= Html::csrfMetaTags() ?>
        <title><?=Yii::$app->name;?> :: <?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
        <?php $this->head() ?>

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>
    <?php

    Modal::begin([
        'header' => '',
        'id' => 'modal',
        'size' => 'modal-medium', //medium
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
    ]);

    echo "<div id='modalContentBackend'>
        <div class='col-lg'>
          <img src='/images/loading.gif' width='280' height='210' alt='loading...'>
        </div>
        </di>";

    Modal::end();
    ?>
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
