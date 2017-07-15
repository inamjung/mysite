<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;

use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AcdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายละเอียดบัญชีลูกค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acdetail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?= Html::a('Create Acdetail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <?php Pjax::begin(['id' => 'mederror-grid']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'hover'=>true,
        'striped'=>false,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'acmain_id',            
            //'customer_id',
            
//            [
//                'attribute'=>'customer_id',
//                //'value'=>'customer.name'
//            ],
//                
//            
            [
                'label' => 'ยอดเงิน',
               'attribute'=> 'amount',
               'format'=>'integer',
               'contentOptions' => ['class' => 'text-center'],
               'headerOptions' => ['class' => 'text-center'],     
            ],
//            [
//               'attribute'=> 'pay',
//               'format'=>'integer', 
//               'contentOptions' => ['class' => 'text-center'],
//               'headerOptions' => ['class' => 'text-center'],     
//            ],
            [
            'label' => 'จ่าย/จ่ายเพิ่ม',
            'attribute' => 'pay',
            'format' => 'raw',
            'value' => function($model) {
                return Html::a(
                                $model['pay'], ['acdetail/updateindex2', 'id' => $model['id'],
                                ], [
                            'data-toggle' => "modal",
                            'data-target' => "#myModalin",
                                // 'data-title'=>"แก้ไขข้อมูล",  
                                ], [
                            //'title'=>'แก้ไขข้อมูล!',
                            'target' => '_blank'
                           
                ]);
            },
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                ],
             //'remark',
                    
        ],
    ]); ?>
     <?php Pjax::end(); ?> 
</div>

 <?php
                Modal::begin([
                    'id' => 'myModalin',
                    'header' => '<h4 class="modal-title"></h4>',
                    'size' => 'modal-lg',
                ]);


                Modal::end();
                ?>
                <?php
                $this->registerJs("
    $('#myModalin').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");
                ?>