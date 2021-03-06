<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccountingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accountings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'pay') ?>

    <?php // echo $form->field($model, 'ac_id') ?>

    <?php // echo $form->field($model, 'ac_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
