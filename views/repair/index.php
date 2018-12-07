<?php
/* @var $this yii\web\View */
$this->title = $one->title;

$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1000])->one();


$title1 = $one->title1 ? $one->title1 : (!empty($content->title) ? $content->title : '');
$title2 = $one->title2 ? $one->title2 : (!empty($content->title2) ? $content->title2 : '');
$description1 = $one->description1 ? $one->description1 : (!empty($content->text) ? $content->text : '');
$description2 = $one->description2 ? $one->description2 : (!empty($content->text2) ? $content->text2 : '');

?>

<div class="container size">

    <?=  app\components\WMenuRepairs::widget(['model'=>$model])?>

    <div class="devices">
        <?php if(!empty($one->show_prices)): ?>

            <?= app\components\WDevicesProblemsPriceList::widget(['model'=>$model])?>

        <?php else: ?>
            <div class="text-center title-main"><div class="seo-title">Выберите ваше устройство</div></div>
            <?=  app\components\WDevices::widget(['model'=>$model])?>
            <?php if(!empty($title1) && !empty($title2)):?>
                <div class="description-seo">
                    <div class="text-center title-main"><h2 class="seo-title"><?=$title1?></h2></div>
                    <div class="text"><?=$description1?></div>
                </div>
                <div class="description-seo">
                    <div class="text-center title-main"><h3 class="seo-title"><?=$title2?></h3></div>
                    <div class="text"><?=$description2?></div>
                </div>
            <?php endif; ?>
            <div class="update-devices-problems-list">
                <?=  app\components\WDevicesProblemsList::widget(['model'=>$model])?>
            </div>
        <?php endif; ?>
    </div>
</div>