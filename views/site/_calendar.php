<?
$monthList = [
    1 => Yii::t('app', "January"),
    2 => Yii::t('app', "February"),
    3 => Yii::t('app', "March"),
    4 => Yii::t('app', "April"),
    5 => Yii::t('app', "May"),
    6 => Yii::t('app', "June"),
    7 => Yii::t('app', "July"),
    8 => Yii::t('app', "August"),
    9 => Yii::t('app', "September"),
    10 => Yii::t('app', "October"),
    11 => Yii::t('app', "November"),
    12 => Yii::t('app', "December"),
];
$m = date('m');
$Y = date('Y');
$days = range(1, date('t'));
for($i = 1; $i<date('w', strtotime(date('01.$m.$Y'))); $i++){
    array_unshifT($days, '');
}

?>
<style>
    ul {list-style-type: none;}
    body {font-family: Verdana, sans-serif;}

    .month {
        padding: 10px 25px;
        width: 100%;
        background: #3c8dbc;
        text-align: center;
    }

    .month ul {
        margin: 0;
        padding: 0;
    }

    .month ul li {
        color: white;
        font-size: 20px;
        text-transform: uppercase;
        letter-spacing: 3px;
    }

    .month .prev {
        float: left;
        padding-top: 10px;
    }

    .month .next {
        float: right;
        padding-top: 10px;
    }

    .weekdays {
        margin: 0;
        padding: 10px 0;
        background-color: #ddd;
    }

    .weekdays li {
        display: inline-block;
        width: 12.6%;
        color: #666;
        text-align: center;
    }

    .days {
        padding: 10px 0;
        background: #eee;
        margin: 0;
    }

    .days li {
        list-style-type: none;
        display: inline-block;
        width: 12.6%;
        text-align: center;
        margin-bottom: 5px;
        font-size:12px;
        color: #777;
    }

    .days li .active {
        padding: 5px;
        background: #3c8dbc;
        color: white !important
    }

    /* Add media queries for smaller screens */
    @media screen and (max-width:720px) {
        .weekdays li, .days li {width: 13.1%;}
    }

    @media screen and (max-width: 420px) {
        .weekdays li, .days li {width: 12.5%;}
        .days li .active {padding: 2px;}
    }

    @media screen and (max-width: 290px) {
        .weekdays li, .days li {width: 12.2%;}
    }
</style>
<div class="month">
    <ul>
        <!--<li class="prev">&#10094;</li>
        <li class="next">&#10095;</li>-->
        <li>
            <?=$monthList[date('n')];?><!--<br>-->
            <span style="font-size:18px"><?=date('Y')?></span>
        </li>
    </ul>
</div>

<ul class="weekdays">
    <li><?=Yii::t('app', 'Mon')?></li>
    <li><?=Yii::t('app', 'Tue')?></li>
    <li><?=Yii::t('app', 'Wed')?></li>
    <li><?=Yii::t('app', 'Thu')?></li>
    <li><?=Yii::t('app', 'Fri')?></li>
    <li><?=Yii::t('app', 'Sat')?></li>
    <li><?=Yii::t('app', 'Sun')?></li>
</ul>

<ul class="days">
    <?foreach ($days as $day):?>
        <?if($day == date('j')):?>
            <li><span class="active"><?=$day?></span></li>
        <?else:?>
            <li><?=$day?></li>
        <?endif;?>
    <?endforeach;?>
    <!--<li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>5</li>
    <li>6</li>
    <li>7</li>
    <li>8</li>
    <li>9</li>
    <li><span class="active">10</span></li>
    <li>11</li>
    <li>12</li>
    <li>13</li>
    <li>14</li>
    <li>15</li>
    <li>16</li>
    <li>17</li>
    <li>18</li>
    <li>19</li>
    <li>20</li>
    <li>21</li>
    <li>22</li>
    <li>23</li>
    <li>24</li>
    <li>25</li>
    <li>26</li>
    <li>27</li>
    <li>28</li>
    <li>29</li>
    <li>30</li>
    <li>31</li>-->
</ul>