<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->

    <div class="alert alert-danger">
        <?php //nl2br(Html::encode($message)) ?>
        <p>
            ยังไม่เปิดใช้งาน
        </p>
    </div>

<!--    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>-->

</div>
