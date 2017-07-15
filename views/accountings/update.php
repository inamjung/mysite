<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Accountings */

$this->title = 'Update Accountings: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Accountings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accountings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
