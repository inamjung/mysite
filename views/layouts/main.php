<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

use yii\helpers\Url;
use dektrium\user\models\User;

AppAsset::register($this);
?>

<div >    
    <img class="img-responsive" src="img/bg6.jpg" alt="..." style="width: 100%; height: 210px;">  
</div>
<?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default',
            //'encodeLabels'=>false
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right',
            'encodeLabels'=>FALSE,
            ],
        'items' => [
            //['label' => '<i class="glyphicon glyphicon-cog"></i> ตั้งค่า', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/user/security/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

<div class="container" style="margin-top: -70px;">
         <?php // Breadcrumbs::widget([
            //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        //]) 
         ?>
    <?php if(!Yii::$app->user->isGuest){ ?>
        <div class="row">
            <div class="col-xs-2 col-sm-2 col-md-2">
                <div class="list-group">
                    <div class="list-group-item active">
                        <left><i class="glyphicon glyphicon-cog"></i> ตั้งค่า</left>
                    </div>                     
<!--                    <a href="<?= yii\helpers\Url::to(['/user/admin/index'])?>" class="list-group-item">
                        <i class="glyphicon glyphicon-user"></i>
                        ผู้ใช้งานระบบ
                    </a>-->
                    <a href="<?= Url::to(['/banks/index'])?>" class="list-group-item">
                        <i class="glyphicon glyphicon-home"></i>
                        ธนาคาร
                    </a>
                    <a href="<?= yii\helpers\Url::to(['/types/index'])?>" class="list-group-item">
                        <i class="glyphicon glyphicon-list-alt"></i>
                        ประเภทรายการ
                    </a>
                    <a href="<?= Url::to(['/customers/index'])?>" class="list-group-item">
                        <i class="glyphicon glyphicon-user"></i> ทะเบียนลูกค้า
                    </a>
                  </div>
                <div class="list-group">
                    <div class="list-group-item active">
                        <left><i class="glyphicon glyphicon-list-alt"></i> เมนู</left>
                    </div> 
                    
                    <a href="<?= Url::to(['/acmain/index'])?>" class="list-group-item">
                        <i class="glyphicon glyphicon-pencil"></i> บันทึกบัญชี
                    </a>
                    <a href="<?= Url::to(['/acdetail/index'])?>" class="list-group-item">
                        <i class="glyphicon glyphicon-edit"></i> รายละเอียดบัญชี
                    </a>
                    <a href="<?= Url::to(['/acmain/sumbyac'])?>" class="list-group-item">
                        <i class="glyphicon glyphicon-stats"></i> รายงาน-ยอดบัญชี
                    </a>
                    <a href="<?= Url::to(['/acmain/cusarrear'])?>" class="list-group-item">
                        <i class="glyphicon glyphicon-stats"></i> รายงาน-ยอดค้างของลูกค้า
                    </a>
                  </div>
            </div>
        <?php }?>    
            <div class="col-xs-10 col-sm-10 col-md-10">                
                <?= $content ?>
            </div>
        </div>
       
        
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
