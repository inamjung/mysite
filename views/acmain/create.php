<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Acmain */

$this->title = 'Create Acmain';
$this->params['breadcrumbs'][] = ['label' => 'Acmains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acmain-create">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->
    <div class="panel panel-info">
        <div class="panel-heading"><i class="glyphicon glyphicon-pencil"></i> บันทึกบัญชี</div>
        <div class="panel-body">
            <?=
            $this->render('_form', [
                'model' => $model,
                'modelDetails' => $modelDetails,
                
            ])
            ?>
        </div>
    </div>


</div>
