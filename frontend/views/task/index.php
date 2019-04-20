<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use \backend\models\TaskToolModel;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '后台任务管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .process{
        width: 50px;
        height: 50px;
        position: absolute;
        left: 50%;
        transform: translate(0,-50%);
    }
</style>

<div class="task-index">
     <div class="process">
         <button type="button" class="btn btn-primary ">主进程PID：<?= $mainProcessId ?></button>
     </div>
    <p>
        <?= Html::a('创建任务', ['create'], ['class' => 'btn btn-success']) ?>
        <button id="todayLog-modal" type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg">今日运行日志</button>
    </p>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">今日运行日志</h4>
                </div>
                <pre>
                     <div class="modal-body" id="modal-body_main"></div>
                </pre>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <?php

    $requestTodayLogUrl = Url::to(['today']);
    $todayLogJs = <<<JS
    $('#todayLog-modal').on('click', function () {
        $.get('{$requestTodayLogUrl}',
            function (data) {
            console.log(data);
                $('#modal-body_main').html(data);
            }  
        );
    });
JS;
    $this->registerJs($todayLogJs);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => 'id',
                'headerOptions' => ['width' => '50'],
            ],
            'name',
            'program',
            [
                'attribute' => 'pid',
                'value' => 'pid',
                'headerOptions' => ['width' => '60'],
            ],
            [
                'attribute' => 'timeOut',
                'value' => function($dataProvider){
                    return $dataProvider->timeOut . '秒';
                },
                'headerOptions' => ['width' => '80'],
            ],
            [
                'attribute' => 'type',
                'label' => '任务类型',
                'value' => function($dataProvider){
                        return Task::$types[$dataProvider->type];
                },
                'filter' => Task::$types,
            ],
            [
                'attribute' => 'info',
                'value' => 'info',
                'headerOptions' => ['width' => '80'],
            ],
            'start_time',
            [
                'attribute' => 'status',
                'label' => '任务状态',
                'value' => function($dataProvider){
                    return Task::$status[$dataProvider->status] ;
                },
                'contentOptions' => function($dataProvider){
                    return  ['class' => Task::$colors[$dataProvider->status]] ;
                },
                'filter' => Task::$status,
            ],
            'last_start_time',
            'last_finish_time',
            'run_time',
            [
                'attribute' => 'is_kill',
                'label' => '进程是否被杀死',
                'value' => function($dataProvider){
                    return $dataProvider->is_kill == 1 ? '是' : '否';
                },
                'filter' => array('0' => '否' ,'1' => '是'),
                'contentOptions' => function($dataProvider){
                    return $dataProvider->is_kill == 0 ? ['class' => 'bg-success'] : ['class' => 'bg-danger'];
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{log}{delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class = "glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;', $url, [
                            'title' => Yii::t('yii','修改'),
                            'aria-label' => Yii::t('yii','修改'),
                            'data-toggle' => 'modal',
                            'data-target' => '#update-modal',
                            'class' => 'data-update',
                            'data-id' => $key,
                        ],['color'=>'red']);
                    },
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class = "glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;', $url, [
                            'title' => Yii::t('yii','查看'),
                            'aria-label' => Yii::t('yii','查看'),
                            'data-toggle' => 'modal',
                            'data-target' => '#view-modal',
                            'class' => 'data-view',
                            'data-id' => $key,
                        ]);
                    },
                    'log' => function ($url, $model, $key) {
                        return Html::a('<span class = "glyphicon glyphicon-book"></span>&nbsp;&nbsp;', $url, [
                            'title' => Yii::t('yii','查看日志'),
                            'aria-label' => Yii::t('yii','查看日志'),
                            'data-toggle' => 'modal',
                            'data-target' => '#log-modal',
                            'class' => 'data-log',
                            'data-id' => $key,
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php

    // 更新操作
    Modal::begin([
        'id' => 'update-modal',
        'header' => '<h4 class="modal-title" style="color: #0d6aad">修改</h4>',
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
        'size' => 'modal-lg',
    ]);
    Modal::end();
    $requestUpdateUrl = Url::toRoute('update');
    $updateJs = <<<JS
    $('.data-update').on('click', function () {
        $.get('{$requestUpdateUrl}', { id: $(this).closest('tr').data('key') },
            function (data) {
                $('.modal-body').html(data);
            }  
        );
    });
JS;
    $this->registerJs($updateJs);
    ?>

    <?php
    // 查看操作
    Modal::begin([
        'id' => 'view-modal',
        'header' => '<h4 class="modal-title" style="color: #0d6aad">查看</h4>',
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
        'size' => 'modal-lg',
    ]);
    Modal::end();
    $requestViewUrl = Url::toRoute('view');
    $viewJs = <<<JS
    $('.data-view').on('click', function () {
        $.get('{$requestViewUrl}', { id: $(this).closest('tr').data('key') },
            function (data) {
                $('.modal-body').html(data);
            }  
        );
    });
JS;
    $this->registerJs($viewJs);
    ?>

    <?php
        //查看日志
    Modal::begin([
        'id' => 'log-modal',
        'header' => '<h4 class="modal-title" style="color: #0d6aad">查看日志</h4>',
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
        'size' => 'modal-lg',
    ]);
    Modal::end();
    $requestLogUrl = Url::toRoute('log');
    $viewJs = <<<JS
    $('.data-log').on('click', function () {
        $.get('{$requestLogUrl}', { id: $(this).closest('tr').data('key') },
            function (data) {
                $('.modal-body').html(data);
            }  
        );
    });
JS;
    $this->registerJs($viewJs);
    ?>

</div>
