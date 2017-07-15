<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Accountings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accountings-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'type_id')->widget(\kartik\select2\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(\app\models\Types::find()->all(), 'id', 'name'),
         'options' => ['placeholder' => '<--ระบุประเภท-->'],
                'pluginOptions' => ['allowClear' => true]
    ]) ?>
     <?= $form->field($model, 'customer_id')->widget(\kartik\select2\Select2::className(),[
        'data'=> yii\helpers\ArrayHelper::map(dektrium\user\models\User::find()->all(), 'id', 'username'),
         'options' => ['placeholder' => '<--ลูกค้า-->'],
                'pluginOptions' => ['allowClear' => true]
    ]) ?>
    
    <?= $form->field($model, 'ac_id')->radioList([ 'i' => 'ได้', 'o' => 'เสีย', ], ['prompt' => '']) ?>


    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'pay')->textInput() ?>
    
    <?=
                    $form->field($model, 'ac_date')->label('รอบบัญชี')->widget(
                            DatePicker::className(), [
                        'language' => 'th',
                        'options' => ['placeholder' => 'รอบบัญชี ...'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                    ]);
                    ?>
<?= $form->field($model, 'name')->label('หมายเหตุ')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
