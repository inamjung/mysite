<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="acdetail-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'hover'=>true,
        'striped'=>false,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'รอบบัญชี',
                'attribute'=>'acmain_id',
                'value'=> function ($model) {
                    return DateThaiSort($model->main->ac_date);

                }
            ],
            [
                'attribute'=>'customer_id',
                'value'=>'customer.name'
            ],
            [
                'label'=>'รายการ/ประเภท',
                'attribute'=>'actype_id',
                'value'=> function ($model) {
                    return $model->typedetail->name;

                }
            ],        
            [
                'attribute'=>'inventory',
                'format' => 'html',
                'value' => function($model){
                    return  $model->inventory == 'i' ? "<i class=\"glyphicon glyphicon-ok\" style=\"color: green\"></i>" : "<i class=\"glyphicon glyphicon-remove\" style=\"color: red\"></i>";
                },
               'contentOptions' => ['class' => 'text-center'],
               'headerOptions' => ['class' => 'text-center'],         
            ],
            [
               'attribute'=> 'amount',
               'format'=>['decimal',2],
               'contentOptions' => ['class' => 'text-center'],
               'headerOptions' => ['class' => 'text-center'],     
            ],
            [
               'attribute'=> 'pay',
               'format'=>['decimal',2], 
               'contentOptions' => ['class' => 'text-center'],
               'headerOptions' => ['class' => 'text-center'],     
            ],
            [
               'label'=>'ยอดค้าง',
               'attribute'=> 'pay',
               'format'=>['decimal',2],
               'value'=> function($model){
                    return $model->pay - $model->amount;                   
                },     
               'contentOptions' => ['class' => 'text-center','style'=>'display:none'], 
               'headerOptions' => ['class' => 'text-center','style'=>'display:none'],     
            ],
             //'remark',
             [
               'class' => '\kartik\grid\FormulaColumn',
               'label'=>'ยอดค้าง',
               'attribute'=> 'pay',
               'format'=>['decimal',2],
               'value'=> function ($model, $key, $index, $widget) {
                 $p = compact('model', 'key', 'index');
                     $target = $widget->col(7, $p);
                        if($target < 0){
                            $st = $model->pay - $model->amount;
                            $stt = preg_replace('[-]', '', $st);
                            return $stt;
                                }else if ($target >= 0){
                                    return '0';
                                }                   
                            },     
                    'contentOptions' => ['class' => 'text-center','style'=>'color:red'], 
                    'headerOptions' => ['class' => 'text-center'],     
            ],           

             ['class' => 'yii\grid\ActionColumn',
              'template'=> '{update}' ,
              'buttons'=>[
                  'update'=> function($url,$model){
                     return Html::a('<span class="glyphicon glyphicon-edit"></span>',['/acdetail/updatecus','id'=>$model->id] ,['title' => 'ดูรายละเอียด', 'class' => 'btn btn-primary']);
                        },
                    ]  
            ],
        ],
    ]); ?>
</div>
