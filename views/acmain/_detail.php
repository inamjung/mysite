<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายละเอียดบัญชีลูกค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acdetail-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'hover'=>true,
        'striped'=>false,
        'showPageSummary'=>true,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            //'acmain_id',            
            //'customer_id',
//            [
//                'label'=>'รอบบัญชี',
//                'attribute'=>'acmain_id',
//                'value'=> function ($model) {
//                    return DateThaiSort($model->main->ac_date);
//
//                }
//            ],
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
                    return  $model->inventory == 'i' ? "<i class=\"glyphicon glyphicon-ok\" style=\"color:green\"></i>" : "<i class=\"glyphicon glyphicon-remove\" style=\"color:red\"></i>";
                },
               'contentOptions' => ['class' => 'text-center'],
               'headerOptions' => ['class' => 'text-center'],  
                        
            ],
            [
               'attribute'=> 'amount',
               'format'=>['decimal',2],
               'contentOptions' => ['class' => 'text-center'],
               'headerOptions' => ['class' => 'text-center'],     
               'pageSummary'=>true
            ],
            [
               'attribute'=> 'pay',
               'format'=>['decimal',2],
               'contentOptions' => ['class' => 'text-center'],
               'headerOptions' => ['class' => 'text-center'],     
               'pageSummary'=>true
            ],
            [
               'label'=>'ยอดค้าง',
               'attribute'=> 'pay',
               'format'=>['decimal',2],
               'value'=> function($model){
                    return $model->pay - $model->amount;                   
                },     
               'contentOptions' => ['class' => 'text-center','style'=>'display: none'], 
               'headerOptions' => ['class' => 'text-center','style'=>'display: none'],  
               //'pageSummary'=>true         
            ],
           [
               'class' => '\kartik\grid\FormulaColumn',
               'label'=>'ยอดค้าง',
               'attribute'=> 'pay',
               'format'=>['decimal',2],
               'value'=> function ($model, $key, $index, $widget) {
                 $p = compact('model', 'key', 'index');
                     $target = $widget->col(6, $p);
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
            [
                'attribute' => 'แก้ไข',
                'format' => 'raw',
                'value' => function($data) {
                 $path = ('index.php?r=/acdetail/updatedetail&id=' . $data->id);                 
                 return Html::a(' <i class="glyphicon glyphicon-edit"> </i>', $path, ['class' => 'btn btn-primary btn-sm', 'title' => Yii::t('kvgrid', 'แก้ไข')]);
                 },
                       'contentOptions' => ['style' => 'width: 50px;text-align:center']
          ],

//             ['class' => 'yii\grid\ActionColumn',
//              'template'=> '{update}' ,
//              'buttons'=>[
//                  'update'=> function($url,$model){
//                     return Html::a('<span class="glyphicon glyphicon-edit"></span>',$url ,['title' => 'ดูรายละเอียด', 'class' => 'btn btn-primary']);
//                        },
//                    ]  
//            ],
        ],
    ]); ?>
</div>
