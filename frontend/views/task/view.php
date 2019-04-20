<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \backend\models\TaskToolModel;

/* @var $this yii\web\View */
/* @var $model backend\models\Task */

//$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'program',
            'pid',
            [
                'attribute' => 'timeOut',
                'label' => '执行超时时间',
                'value'=>function($model){
                    return $model->timeOut.'秒';
                }
            ],
            [
                'attribute' => 'type',
                'label' => '任务类型',
                'value'=>function($model){
                    return Task::$types[$model->type];
                }
            ],
            'start_time',
            [
                'attribute' => 'info',
                'label' => '任务信息',
                'value'=>function($model){
                    return $model->type == 2 ? $model->info . '秒' : $model->info;
                }
            ],
            [
                'attribute' => 'status',
                'label' => '任务状态',
                'value'=>function($model){
                    return Task::$status[$model->status];
                }
            ],
            'last_start_time',
            'last_finish_time',
            'next_start_time',
            'run_time',
            [
                'attribute' => 'is_kill',
                'label' => '进程是否杀死',
                'value'=>function($model){
                    return $model->is_kill == 1 ? '是' : '否';
                }
            ],
        ],
    ]) ?>

</div>
