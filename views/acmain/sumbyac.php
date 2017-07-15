<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รวมยอดบัญชีตามรอบ';
$this->params['breadcrumbs'][] = $this->title;

$datas = $dataProvider->getModels();
?>
<div class="acdetail-index">
   <?php \yii\widgets\ActiveForm::begin(['method'=>'get',
       'action'=> yii\helpers\Url::to(['/acmain/sumbyac'])
       ])?>
   
    <div class="well">
        <alert class="alert alert-info">สรุปยอดบัญชีตามรอบ</alert><hr/>
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                จากวันที่ :
                <?php 
                    echo \yii\jui\DatePicker::widget([
                        'name'=>'date1',
                        'value'=>$date1,
                        'language'=>'th',
                        'dateFormat'=>'yyyy-MM-dd',
                        'clientOptions'=>[
                            'changeMonth'=>true,
                            'changeYear'=>true
                        ],
                        'options'=>[
                            'class'=>'form-control'
                        ]
                    ])                
                ?>
                <br/>
                ถึงวันที่ :
                <?php 
                    echo \yii\jui\DatePicker::widget([
                        'name'=>'date2',
                        'value'=>$date2,
                        'language'=>'th',
                        'dateFormat'=>'yyyy-MM-dd',
                        'clientOptions'=>[
                            'changeMonth'=>true,
                            'changeYear'=>true
                        ],
                        'options'=>[
                            'class'=>'form-control'
                        ]
                    ])                
                ?>
            </div>
             <br/>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <button class="btn btn-danger"> ประมวลผล</button>
            </div>            
        </div>        
    </div>
    
    <?php \yii\widgets\ActiveForm::end()?>
    
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
        'showPageSummary'=>true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'label'=>'รอบบัญชี',
                'attribute'=>'ac_date',
                'value'=> function($model){
                    return DateThai($model['ac_date']);
                },
                  'pageSummary'=>'รวมทั้งสิ้น'        
       
            ],
            [
                'label'=>'รวมยอดเงิน',
                'attribute'=>'amount',
                'format'=>['decimal',2],
                'pageSummary'=>true,
                'contentOptions'=>['class'=>'text-center'],
                'headerOptions'=>['class'=>'text-center']
       
            ],
            [
                'label'=>'รวมยอดชำระ',
                'attribute'=>'pay',
                 'format'=>['decimal',2],
                 'pageSummary'=>true,
                'contentOptions'=>['class'=>'text-center'],
                'headerOptions'=>['class'=>'text-center']
       
            ],
            [
                'label'=>'รวมยอดค้าง',
                'attribute'=>'total',
                'format'=>['decimal',2],
                'pageSummary'=>true ,
                'contentOptions'=>['class'=>'text-center','style'=>'color: red'],
                'headerOptions'=>['class'=>'text-center','style'=>'color: red']
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