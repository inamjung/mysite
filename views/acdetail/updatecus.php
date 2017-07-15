<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Acdetail */

$this->title = 'แก้ไขรายการของลูกค้า: ' . $model->customer->name;
//$this->params['breadcrumbs'][] = ['label' => 'Acdetails', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="acdetail-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="panel panel-warning">
        <div class="panel-heading"> แก้ไขรายการ</div>
        <div class="panel-body">
            <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
    </div>
</div>
