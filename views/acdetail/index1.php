<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ค้างชำระ';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>
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
            
            [
                'attribute'=>'customer_id',
                //'value'=>'customer.name'
            ],
                
           
            [
               'attribute'=> 'amount',
               'format'=>'integer',
               'contentOptions' => ['class' => 'text-center'],
               'headerOptions' => ['class' => 'text-center'],     
            ],
            [
               'attribute'=> 'pay',
               'format'=>'integer', 
               'contentOptions' => ['class' => 'text-center'],
               'headerOptions' => ['class' => 'text-center'],     
            ],
            
             //'remark',

             
        ],
    ]); ?>


   <?php

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		$strYear=substr($strYear,2,2);
		return "$strDay $strMonthThai $strYear";
	}       
?>