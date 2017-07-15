<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use kartik\date\DatePicker;
use app\models\AcdetailSearch;
use app\models\Acdetail;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcmainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บันทึกบัญชี';
$this->params['breadcrumbs'][] = $this->title;
$time = time();
?>
<div class="acmain-index">

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p class="pull-right">
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> บันทึกบัญชี', ['create'], ['class' => 'btn btn-success']) ?>
    </p><br><br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover'=>true,
        'striped'=>false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value'=> function($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;                    
                },
                'detail'=> function($model, $key, $index, $column){
                    $searchModel = new AcdetailSearch();
                    $searchModel ->acmain_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    
                    return Yii::$app->controller->renderPartial('_detail',[
                        'searchModel'=> $searchModel,
                        'dataProvider'=> $dataProvider,
                    ]);
                 }
                ],
                [
                'label'=>'รอบบัญชี',
                'attribute'=>'ac_date',
                'value'=> function ($model) {
                    return DateThai($model->ac_date);

                }
            ],        
//            [
//                'label' => 'วันที่จ่าย',
//                'attribute' => 'ac_date',
//                'value'=>function($model){
//                        return DateThai($model->ac_date);
//                        },
//                'width' => '300px',
//                'filterType' => GridView::FILTER_DATE,
//                'filterWidgetOptions' => [
//                    'options' => ['placeholder' => 'ค้นหาตามวันที่ ...'], //this code not giving any changes in browser
//                    'type' => DatePicker::TYPE_COMPONENT_APPEND, //this give error Class 'DatePicker' not found
//                    'language'=>'th',
//                    'pluginOptions' => [
//                        'autoclose' => true,
//                        'format' => 'yyyy-mm-dd'
//                    ],
//                ],                
//            ],
           
                      
            //'user_id',
            //'create_at',
            // 'update_at',

           ['class' => 'yii\grid\ActionColumn',
               'template'=>'{update}',
               'buttons'=> [
                   'update'=> function($url,$model){
                        return Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข',$url,['class'=>'btn btn-success']);
                   },
               ]
               
               ],
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
		//$strYear=substr($strYear,2,2);
		return "$strDay $strMonthThai $strYear";
	}       
?>
<?php

function DateThaiSort($strDate)
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