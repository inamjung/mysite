<?php
use dektrium\user\models\User;
/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Likes</span>
    <span class="info-box-number">93,139</span>
  </div><!-- /.info-box-content -->
</div><!-- /.info-box -->
           <?php echo \app\models\Customers::find()->count() ;?>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            
            <img style="height:400px; width:320px;" src="./img/note.jpg"
                 class="img-responsive"
             alt="..."
             >
           
        </div>
    </div>

    
</div>
