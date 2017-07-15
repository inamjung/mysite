<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Banks */

$this->title = 'เพิ่มชื่อธนาคาร';
$this->params['breadcrumbs'][] = ['label' => 'Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
