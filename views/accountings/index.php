<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการบัญชี';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accountings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="pull-right">
        <?= Html::a('บันทึกบัญชี', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'type_id',
            'customer_id',
            'amount',
             'pay',
             'ac_id',
             'ac_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
