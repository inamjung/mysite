<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\AcdetailSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="pull-right">
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i>เพิ่มลูกค้า', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <br><br><br>
    <div class="panel panel-default">
        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> ทะเบียนรายชื่อลูกค้า</div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'hover' => true,
                'striped' => false,
                'filterModel' => $searchModel,
                
                
                'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value'=> function($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;                    
                },
                'detail'=> function($model, $key, $index, $column){
                    $searchModel = new AcdetailSearch();
                    $searchModel ->customer_id = $model->name;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    
                    return Yii::$app->controller->renderPartial('_detail',[
                        'searchModel'=> $searchModel,
                        'dataProvider'=> $dataProvider,
                    ]);
                 }
                ],
                    
                    //'id',
                    'name',
                    'tel',
                    'addr',
                    'blank',
                    'book_no',
                    ['class' => 'yii\grid\ActionColumn',
                      'contentOptions'=>[
                        'noWrap' => true,                     
                        ],
                        'template'=>'{view}{update}{delete}' , 
                          'buttons'=>[
                              'view'=> function($url,$model){
                                    return Html::a('<i class="glyphicon glyphicon-search"></i>',$url
                                            ,['target' => '_blank', 'data-pjax' => 0,
                                                'class'=>'btn btn-info','title'=>'รายละเอียด']);
                              },
                            'update'=> function($url,$model){
                                    return Html::a('<i class="glyphicon glyphicon-edit"></i>',$url
                                            ,['class'=>'btn btn-success','title'=>'แก้ไข']);
                              },
                            'delete'=>function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-remove"></i>', $url,[
                                           'title' => Yii::t('yii', 'Delete'),
                                           'data-confirm' => Yii::t('yii', 'คุณต้องการลบไฟล์นี้?'),
                                           'data-method' => 'post',
                                           'data-pjax' => '0',
                                           'class'=>'btn btn-danger'
                                           ]);
                    }  
                          ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>

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