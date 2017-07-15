<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ทะเบียนลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-view">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    <?php 
        $dataProvider = new ActiveDataProvider([
            'query'=> app\models\Acdetail::find()
                ->where(['customer_id' =>$model->id])
                ->orderBy('id desc')->limit('1'),
            'pagination'=>[
                'pageSize'=> 20
            ]
        ]);    
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'name',
            'tel',
            'addr',
            'blank',
            'book_no',
        ],
    ]) ?>
    <table class="table">
        <thead>
            <tr>
<!--                <td>#</td>-->
                <td>รอบบัญชี</td>
                <td>รายการ</td>
                <td>ได้/เสีย</td>
                <td>ยอดเงิน</td>
                <td>ยอดชำระ</td>
                <td style="color: red">ยอดค้าง</td>
            </tr>
        </thead>
        <tbody>
            <?php $i =1 ;?>
            <?php foreach (app\models\Acdetail::find()->where(['customer_id' => $model->id])->all() as $row): ?>
            <tr>
<!--                <td><?= $i++ ;?></td>-->
                <td><?= DateThai($row->main->ac_date);?></td>
                <td><?= $row->typedetail->name ;?></td>
                <td><?= $row->inventory  == 'i' ? "<i class=\"glyphicon glyphicon-ok\" style=\"color: green\"></i>" : "<i class=\"glyphicon glyphicon-remove\" style=\"color: red\"></i>" ;?></td>
                <td><?= number_format($row->amount,2) ;?></td>
                <td><?= number_format($row->pay,2) ;?></td>
                <td style="color: red"><?= number_format($row->pay - $row->amount,2) ;?></td>
            </tr>
           
            <?php endforeach ;?>
            
            <tr>
                   
            <td style="text-align: center" colspan="3"><strong> รวมทั้งสิ้น</strong></td>            
            <td style="text-align: left" colspan="1" class="center"><strong>
                <?php echo (app\models\Acdetail::find()->where(['customer_id'=>$model->id])->sum('amount')); ?></strong></td>
            <td style="text-align: left" colspan="1" class="center"><strong>
                <?php echo (app\models\Acdetail::find()->where(['customer_id'=>$model->id])->sum('pay')); ?></strong></td>
            <td style="color: red; text-align: left" colspan="1" class="center"><strong>
                <?php 
                    $a = app\models\Acdetail::find()->where(['customer_id'=>$model->id])->sum('amount');
                    $b = app\models\Acdetail::find()->where(['customer_id'=>$model->id])->sum('pay'); 
                    $c = $b-$a;
                    echo $c;
                ?>
            </strong></td>
        </tbody>
    </table>

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