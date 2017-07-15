<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประเภทรายการ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="types-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="pull-right">
        <?= Html::a('เพิ่มรายการ', ['create'], ['class' => 'btn btn-success']) ?>
    </p><br><br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'striped'=>false,
        'hover'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'detail',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
