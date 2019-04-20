<?php

use backend\models\TaskLog;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cases */

//$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Cases', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cases-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'info',
                'label' => '日志信息',
                'format' => 'html',
                'value' => function($model){
                    $str = '';
                    $logs = TaskLog::find()->where(['task_id' => $model->id])->all();
                    foreach ($logs as $item){
                        $str .= $item->start_time ." --> 任务[$model->program]开始执行"."<br>";
                        $str .= $item->finish_time ." --> 任务[$model->program]执行结束"."<br>";
                    }
                    return $str;
                },
            ],
        ],
    ]) ?>

</div>
