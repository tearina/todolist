<?php
use yii\bootstrap\Modal;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use himiklab\colorbox\Colorbox;
/*
* @var $this yii\web\View
* @var $taskList yii\data\ActiveDataProvider
*/
$this->title = 'Todolist';

echo Colorbox::widget([
    'targets' => [
        '.colorbox' => [
            'maxWidth' => 200,
            'maxHeight' => 200
        ],
    ],
    'coreStyle' => 2
])
?>

<h1>Список дел</h1>
<a href="/task/create" class="ajax-link task-create btn btn-primary pull-right">Добавить</a>
<div class=" application-list">
    <div class="row">
        <?= ListView::widget([
            'summary' => false,
            'emptyText' => 'Дел нет',
            'dataProvider' => $taskList,
            'itemOptions' => ['class' => 'thumbnail col-sm-12 col-md-12'],
            'itemView' => '_task',
            'layout' => '{items}',
            'options' => ['class' => 'task-list ']
        ]) ;?>
        <div class="clearfix"></div>
    </div>
</div>

