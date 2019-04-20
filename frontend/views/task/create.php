<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Task */

$this->title = '创建后台任务';
$this->params['breadcrumbs'][] = ['label' => '后台任务管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
