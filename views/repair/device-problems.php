<?php
/**
 * Created by PhpStorm.
 * User: Strogg
 * Date: 30.07.2018
 * Time: 21:21
 */
$this->title = $one->title;
?>
<div id="repair">

    <div class="devices">
        <div class="text-center"><h2>Выберите ваше устройство</h2></div>
        <?=  app\components\WDevices::widget(['model'=>$model])?>
        <br>
        <?=  app\components\WDevicesProblemsGroups::widget(['model'=>$model])?>

    </div>

</div>
