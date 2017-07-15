<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = 'บันทึกข้อมูลลูกค้า';
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-create">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->

    <div class="panel panel-info">
        <div class="panel-heading"><i class="glyphicon glyphicon-pencil"></i> บันทึกข้อมูลลูกค้า</div>
        <div class="panel-body">
            <?=
            $this->render('_form', [
                'model' => $model,                
            ])
            ?>
        </div>
    </div>

</div>
