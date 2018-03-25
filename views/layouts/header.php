<?php
use yii\helpers\Html;
use app\models\Employee;
/* @var $this \yii\web\View */
/* @var $content string */
$cookies = Yii::$app->request->cookies;
$employee_id = $cookies->getValue('employee_id');

$employee = Employee::findOne($employee_id);
//vd($employee);
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">PG</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/<?=$employee->avatar?>" class="user-image img-circle" alt="Avatar"/>
                        <span class="hidden-xs"><?=Yii::$app->user->identity->username?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="/<?=$employee->avatar?>" class="img-circle" alt="Avatar"/>
                            <p>
                                <?=$employee->fname?>
                                <?=$employee->name?>
                                <?=$employee->oname?> (<?=Yii::$app->user->identity->username?>)
                                <small>Member since <?=$employee->join_date?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">

                            <p class="text-center">
                                <?if(Yii::$app->user->identity->priority == 1):?>
                                <a class="btn btn-primary" href="/admin/employees/gamers">Админ панель</a>
                                <?endif;?>
                                <a class="btn btn-info" href="/employees/rating">Передача баллов</a>
                            </p>

                            <div class="col-xs-4 text-center">
                                <b>Отдел</b>
                                <span><?=$employee->branch->name?></span>
                            </div>
                            <div class="col-xs-4 text-center">
                                <b>Команда</b>
                                <span><?=$employee->team->name?></span>
                            </div>
                            <div class="col-xs-4 text-center">
                                <b>Должность</b>
                                <span><?=$employee->position->name?></span>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Профиль',
                                    ['/site/profile'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Выход',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!--<li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>-->
            </ul>
        </div>
    </nav>
</header>
