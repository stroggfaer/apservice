<?php
/**
 * Created by PhpStorm.
 * User: Strogg
 * Date: 03.08.2018
 * Time: 17:16
 */
$this->title = $one->title;

?>
<br>
<br>
<br>
<br>
<?=  app\components\WDevicesProblems::widget(['model'=>$model,'one'=>$one])?>
<br>
<br>

<div class="devices-problems text-center">
    <div class="">Цена сервисах</div>
    <h2 class="name"><b><?=$one->description?> на <?=$one->device->title?></b></h2>
    <div><h3><?=$one->price->money?> руб. / <?=$one->time?></h3></div>
</div>
