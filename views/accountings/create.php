<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Accountings */

$this->title = 'Create Accountings';
$this->params['breadcrumbs'][] = ['label' => 'Accountings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accountings-create">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->
    <div class="panel panel-info">
        <div class="panel-heading"> บันทึกบัญชีรายตัว</div>
        <div class="panel-body">
             <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
    </div>
   

</div>
