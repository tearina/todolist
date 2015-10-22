<?php
    use yii\widgets\ListView;
    /*
     * @var $this yii\web\View
     * @var $taskList yii\data\ActiveDataProvider
     */
?>
<div class="task-list">
    <div class="row">
        <?= ListView::widget([
            'summary' => false,
            'emptyText' => 'Дел нет',
            'dataProvider' => $taskList,
            'itemOptions' => ['class' => 'thumbnail col-sm-12 col-md-12'],
            'itemView' => '_task',
            'layout' => '{items}',
        ]) ;?>
        <div class="clearfix"></div>
    </div>
</div>