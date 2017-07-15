<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use yii\bootstrap\Modal;
use app\models\Acdetail;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Acmain */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $this->registerJs("
    $('.delete-button').click(function() {
        var detail = $(this).closest('.acmain-detail');
        var updateType = detail.find('.update-type');
        if (updateType.val() === " . json_encode(\app\models\Acdetail::UPDATE_TYPE_UPDATE) . ") {
            //marking the row for deletion
            updateType.val(" . json_encode(\app\models\Acdetail::UPDATE_TYPE_DELETE) . ");
            detail.hide();
        } else {
            //if the row is a new row, delete the row
            detail.remove();
        }
    });

");
?>
<div class="acmain-form">

    <?php $form = ActiveForm::begin(); ?>   
     <div class="row">
         <div class="col-xs-4 col-sm-4 col-md-4">
              <?=
                    $form->field($model, 'ac_date')->widget(
                            DatePicker::className(), [
                        'language' => 'th',
                        'options' => ['placeholder' => 'รอบบัญชี ...'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true,
                            'autoclose'=>true
                        ]
                    ]);
                    ?>
         </div>
         
     </div>
    
    <hr/>
    <?php foreach ($modelDetails as $i => $modelDetail) : ?>
        <div class="row acmain-detail acmain-detail-<?= $i ?>">
            <div class="col-md-2">
                <?= Html::activeHiddenInput($modelDetail, "[$i]id") ?>
                <?= Html::activeHiddenInput($modelDetail, "[$i]updateType", 
                        ['class' => 'update-type']) ?>                
                <?= $form->field($modelDetail, "[$i]customer_id")
                            ->widget(\kartik\select2\Select2::className(),[
                    'data'=> ArrayHelper::map(app\models\Customers::find()->all(), 'id','name'),
                    'options'=>['placeholder'=>'<--ลูกค้า-->'],
                    'pluginOptions'=>['allowClear'=>true]
                ]) ?>
                 </div>
            <div class="col-md-1">
                    <?= $form->field($modelDetail, "[$i]inventory")
                            ->radioList(['i'=>'ได้','o'=>'เสีย']) ?>                    
                </div>
                <div class="col-md-2">
                   <?= $form->field($modelDetail, "[$i]actype_id")
                                ->widget(\kartik\select2\Select2::className(),            [
                        'data'=> yii\helpers\ArrayHelper::map(\app\models\Types::find()->all(), 'id', 'name'),
                        'options'=>[
                            'placeholder'=>'ระบุรายการ/ประเภท...'
                        ],
                        'pluginOptions'=>['allowClear'=>true]
                    ]) ?>
                </div>
            
                    <?php  $arr = Acdetail::find()
                            ->where(['customer_id' => $modelDetail->customer_id])
                            ->sum('arrear');
                    ?>
                    <?php  $a = preg_replace('[-]','',$arr )?>
            
                    <?php $inveno = Acdetail::find()
                            ->where(['customer_id'=>$modelDetail->customer_id])
                            ->andWhere(['inventory'=>'o'])
                            ->sum('arrear');
                    ?>
                    <?php $inven = preg_replace('[-]', '', $inveno) ;?>
            
                    <?= Html::a('ค้าง', ['/acdetail/get-customer',
                        'customer_id' => $modelDetail->customer_id], 
                            ['class' => 'btn btn-primary',
                             'target'=>'_blank'
                                ])
                    ?>
               
            <div class="col-md-2">
                <?= $form->field($modelDetail, "[$i]remark")->label('ค้างยกมา')
                            ->textInput(['readonly'=>true,'value'=> $inven])?>
            </div>    
            <div class="col-md-2" style="display: none">
                    <?= $form->field($modelDetail, "[$i]total_arrear")->label('ค้างยกมา')
                             ->textInput(['readonly'=>true,'value' => $a])
                    ?>
                    
                </div>            
                
                <div class="col-md-2">
                    <?= $form->field($modelDetail, "[$i]amount")->label('ยอดครั้งนี้') ?>
                    
                                       
                </div>
                <div class="col-md-2">
                    <?= $form->field($modelDetail, "[$i]pay") ?>                    
                </div>
                


            <div class="col-md-1">
                <?= Html::button('x', ['class' => 'delete-button btn btn-danger', 
                    'data-target' => "acmain-detail-$i"]) ?>
            </div>
        </div>
     <hr>
    <?php endforeach; ?>
   
    <div class="form-group" >
        <p class="pull-right">
            
            <?= Html::submitButton('<i class="glyphicon glyphicon-repeat"></i> เช็ค',
                ['name' => 'addRow', 'value' => 'true', 'class' => 'btn btn-info']) ?>
            <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> เพิ่ม',
                ['name' => 'addRow', 'value' => 'true', 'class' => 'btn btn-warning']) ?>
            <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-ok"></i> บันทึก' : '<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </p>
        
    </div>
   

    <div class="form-group">
        
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS
        
JS;
$this->registerJs($script);
?>

   