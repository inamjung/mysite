<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AcdetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acdetail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'acmain_id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'inventory') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'pay') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
