<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Acdetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acdetail-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'actype_id')->widget(\kartik\widgets\Select2::className(),[
        'data'=> \yii\helpers\ArrayHelper::map(\app\models\Types::find()->all(), 'id', 'name'),
        'options'=>[
            'placeholder'=>'รายการ...'
        ],
        'pluginOptions'=>[
            'allowClear'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'inventory')->radioList(['i'=>'ได้','o'=>'เสีย']) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-ok"></span> บันทึก' : '<span class="glyphicon glyphicon-ok"></span> บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
