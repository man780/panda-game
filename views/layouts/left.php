<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!--<div class="user-panel">
            <div class="pull-left image">
                <img src="<?/*= $directoryAsset */?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->

        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => Yii::t('app', 'Home'), 'url' => ['/']],
                    ['label' => Yii::t('app', 'Store'), 'url' => ['/store/index']],
                    ['label' => Yii::t('app', 'Achievements'), 'url' => ['/achievements/index']],
                    ['label' => Yii::t('app', 'Global rating'), 'url' => ['/rating/global']],
                    ['label' => Yii::t('app', 'Teams rating'), 'url' => ['/rating/teams']],
                    ['label' => Yii::t('app', 'About company'), 'url' => ['/company/index']],
                    //['label' => 'Структура компания', 'url' => ['/company/structure']],
                    ['label' => Yii::t('app', 'News'), 'url' => ['/news/index']],
                    ['label' => Yii::t('app', 'Media'), 'url' => ['/media/index']],
                    ['label' => Yii::t('app', 'Useful documents'), 'url' => ['/documents/index']],
                    //['label' => 'Контент', 'url' => ['/content/index']],
                    //['label' => 'Докменты', 'url' => ['/documents/index']],
                    //['label' => 'Задачи', 'url' => ['/task/index']],

                    //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    //['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    /*[
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],*/
                ],
            ]
        ) ?>

    </section>

</aside>
