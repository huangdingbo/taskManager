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

    <p><?=$todayLog?></p>

</div>
