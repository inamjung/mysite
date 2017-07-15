<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Acdetail */

$this->title = 'Create Acdetail';
$this->params['breadcrumbs'][] = ['label' => 'Acdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acdetail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
