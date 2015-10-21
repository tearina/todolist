<?php
use yii\bootstrap\Modal;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/*
* @var $this yii\web\View
* @var $taskList yii\data\ActiveDataProvider
*/
$this->title = 'Todolist';
?>

<h1>Список дел</h1>
<a href="/task/create" class="ajax-link">Добавить</a>
<div class=" application-list">
    <div class="row">
        <?= ListView::widget([
            'summary' => false,
            'emptyText' => 'Дел нет',
            'dataProvider' => $taskList,
            'itemOptions' => ['class' => 'item thumbnail'],
            'itemView' => '_task',
            'layout' => '{items}<div class="clearfix"></div>{pager}',
            'options' => ['class' => 'task-list col-sm-6 col-md-9']
        ]) ;?>
        <div class="clearfix"></div>
    </div>
</div>

