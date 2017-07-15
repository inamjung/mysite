<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Acmain */

$this->title = 'Update Acmain: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Acmains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="acmain-update">

    <div class="panel panel-warning">
        <div class="panel-heading"><i class="glyphicon glyphicon-pencil"></i> แก้ไขบันทึกบัญชี</div>
        <div class="panel-body">
            <?=
            $this->render('_form', [
                'model' => $model,
                'modelDetails' => $modelDetails
            ])
            ?>
        </div>
    </div>

</div>
