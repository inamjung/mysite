<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\AcmainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acmain-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading"> ค้นหาข้อมูล</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <?=
                    $form->field($model, 'ac_date1')->label('จากรอบบัญชี')->widget(
                            DatePicker::className(), [
                        'language' => 'th',
                        'options' => ['placeholder' => 'จากรอบบัญชี ...'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <?=
                    $form->field($model, 'ac_date2')->label('ถึงรอบบัญชี')->widget(
                            DatePicker::className(), [
                        'language' => 'th',
                        'options' => ['placeholder' => 'ถึงรอบบัญชี ...'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <?= $form->field($model, 'actype_id')->widget(kartik\widgets\Select2::className(),[
                    'data'=> yii\helpers\ArrayHelper::map(\app\models\Types::find()->all(), 'id', 'name'),
                    'options'=>[
                        'placeholder'=>'ระบุรายการ/ประเภท...'
                    ],
                    'pluginOptions'=>[
                        'allowClear'=>true
                    ]
                ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
