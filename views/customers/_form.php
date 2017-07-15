<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'addr')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'blank')->widget(kartik\widgets\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(app\models\Banks::find()->all(), 'name', 'name'),
        'options'=>[
            'placeholder'=>'ธนาคาร...'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'book_no')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-ok"></i> บันทึก' : '<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
