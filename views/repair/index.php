<?php
/* @var $this yii\web\View */
$this->title = $one->title;
?>
<br>
<br>
<div id="repair">
    <?=  app\components\WMenuRepairs::widget(['model'=>$model])?>
    <div class="devices">
        <div class="text-center"><h2>Выберите ваше устройство</h2></div>
        <?=  app\components\WDevices::widget(['model'=>$model])?>
    </div>

</div>
