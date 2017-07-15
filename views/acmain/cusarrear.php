<?php

use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AcdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สรุปยอดค้างของลูกค้า';
$this->params['breadcrumbs'][] = $this->title;

$datas = $dataProvider->getModels();
?>
<div class="acdetail-index">
    
<?php 
    if(count($datas) == 0){
        echo "<div class='alert alert-info'>ยังไม่มีผลลัพธ์จากการค้นหาข้อมูล</div>";
        return;
    }
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'hover'=>true,
        'striped'=>false,
        //'showPageSummary'=>true,
        'panel'=>[
            'header'=>''
        ],
        'toolbar'=>[],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'label'=>'ลูกค้า',
                'attribute'=>'name',
                        
            ],
            [
                'label'=>'ยอดค้าง',
                'attribute'=>'cusarrear',
                'format'=>['decimal',2],
                'pageSummary'=>true,
                'contentOptions'=>['class'=>'text-center'],
                'headerOptions'=>['class'=>'text-center']
       
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
