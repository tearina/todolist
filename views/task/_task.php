<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $model yii\web\Task*/
?>
<!--<a href="<?= Url::to(['application/view', 'id' => $model -> id]) ?>">  -->
    <span><?= $model -> task ?></span>
    <?php if ($model -> attachment) :?>
        <?php if ($model -> attachment -> is_pic) :?>
            <img src="/upload/<?= $model -> attachment -> name?>">
        <?php else: ?>
            <span><?= $model -> attachment -> name ?></span>
        <?php endif;?>
    <?php endif;?>
<!-- </a>  -->
