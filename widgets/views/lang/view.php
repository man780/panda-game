<?php
use yii\helpers\Html;
?>
<div class="col-md-2 col-sm-4 col-xs-4 nopadding">
    <style>
        .dropbtn {
            background-color: #336699;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            margin-left: 10px;
        }
        .dropdown-content li {
            list-style-type: none;
        }

        .dropdown-content a:hover {color: blue}

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
        #flags {
            background-repeat: no-repeat;
            background-position: left;
            float: left;
            margin-left: -10px;
        }
    </style>

    <div class="dropdown" id="lang" style="width: 130px;">
        <button class="dropbtn" id="current-lang"><i class="fa fa-language" aria-hidden="true"></i> <?= $current->name;?> <i class="fa fa-angle-down" aria-hidden="true"></i></button>
        <ul class="dropdown-content" id="langs">
            <?php foreach ($langs as $lang):?>
                <li class="item-lang">
                    <i id="flags" style="background-image:url(/images/<?= $lang->icon;?>);"><?= Html::a($lang->name, '/'.$lang->url.Yii::$app->getRequest()->getLangUrl()) ?></i>
                </li>
            <?php endforeach;?>
        </ul>
    </div>

</div>


