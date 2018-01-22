<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.01.2018
 * Time: 12:28
 */
use yii\bootstrap\Tabs;

echo Tabs::widget([
    'items' => [
        [
            'label' => 'Информация',
            'content' => $this->render('_info', ['model' => $model]),
            'active' => true
        ],
        [
            'label' => 'Отделы',
            'content' => $this->render('_branches', ['branches' => $branches]),
        ],
        [
            'label' => 'Команды',
            'content' => $this->render('_teams', ['teams' => $teams]),
        ],
    ],
]);