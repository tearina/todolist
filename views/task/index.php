<?php
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

<h1>Список задач</h1>
<a href="/task/create" class="ajax-link task-create btn btn-primary pull-right" data-type="open_modal">Добавить</a>

<!-- task list -->
<?= $this -> render('_list', ['taskList' => $taskList])?>


