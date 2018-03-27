<?php
/**
 * Created by PhpStorm.
 * User: Murod
 * Date: 27.03.2018
 * Time: 2:09
 */
use dosamigos\chartjs\ChartJs;
use yii\helpers\Url;
use app\models\Employee;

foreach ($dates as $key => $date){
    $dates2[$key] = date('d.m.Y', strtotime($date));
}

$datasets = [];
/*foreach (){

}*/
foreach ( $tableArr as $key => $item) {
    $r = rand(1, 255);
    $g = rand(1, 255);
    $b = rand(1, 255);
    $datasets[] = [
        'label' => Employee::find()->where(['id' => $key])->one()->fname.' '.Employee::find()->where(['id' => $key])->one()->name,
        'backgroundColor' => "rgba(".$r.",".$g.",".$b.",0.2)",
        'borderColor' => "rgba(".$r.",".$g.",".$b.",1)",
        'pointBackgroundColor' => "rgba(".$r.",".$g.",".$b.",1)",
        'pointBorderColor' => "#fff",
        'pointHoverBackgroundColor' => "#fff",
        'pointHoverBorderColor' => "rgba(".$r.",".$g.",".$b.",1)",
        'data' => array_values($item),
    ];
}
//vd($datasets);
$datasets = $datasets;
//vd($datasets, false);
/*$datasets = [[
    'label' => "My First dataset",
    'backgroundColor' => "rgba(179,181,198,0.2)",
    'borderColor' => "rgba(179,181,198,1)",
    'pointBackgroundColor' => "rgba(179,181,198,1)",
    'pointBorderColor' => "#fff",
    'pointHoverBackgroundColor' => "#fff",
    'pointHoverBorderColor' => "rgba(179,181,198,1)",
    'data' => [65, 59, 90, 81, 56, 55, 40]
],
    [
        'label' => "My Second dataset",
        'backgroundColor' => "rgba(255,99,132,0.2)",
        'borderColor' => "rgba(255,99,132,1)",
        'pointBackgroundColor' => "rgba(255,99,132,1)",
        'pointBorderColor' => "#fff",
        'pointHoverBackgroundColor' => "#fff",
        'pointHoverBorderColor' => "rgba(255,99,132,1)",
        'data' => [28, 48, 40, 19, 96, 27, 100]
    ]];
vd($datasets);*/
?>
    <div class="jumbotron">
        <a href="<?=Url::toRoute('settings/create')?>" class="btn btn-primary">
            Выставить баллы
        </a>
        <a href="<?=Url::toRoute('settings/index')?>" class="btn btn-success">
            Таблица
        </a>
    </div>
<?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 400,
        'width' => 400
    ],
    'data' => [
        'labels' => $dates2,
        'datasets' => $datasets
            /*[
                'label' => "My First dataset",
                'backgroundColor' => "rgba(179,181,198,0.2)",
                'borderColor' => "rgba(179,181,198,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => [65, 59, 90, 81, 56, 55, 40]
            ],
            [
                'label' => "My Second dataset",
                'backgroundColor' => "rgba(255,99,132,0.2)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(255,99,132,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => [28, 48, 40, 19, 96, 27, 100]
            ]*/

    ]
]);
?>