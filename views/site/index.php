<?php
/* @var $this yii\web\View */
use app\models\Options;
/* @var $this yii\web\View */
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();
$pageTrainer = \app\models\Pages::find()->where(['id'=>1005,'status'=>1])->one();
$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1000])->one();

$title1 = $one->title1 ? $one->title1 : (!empty($content->title) ? $content->title : '');
$title2 = $one->title2 ? $one->title2 : (!empty($content->title2) ? $content->title2 : '');
$description1 = $one->description1 ? $one->description1 : (!empty($content->text) ? $content->text : '');
$description2 = $one->description2 ? $one->description2 : (!empty($content->text2) ? $content->text2 : '');

?>
<div class="container size">
    <?=  app\components\WMenuRepairs::widget(['model'=>$model])?>

    <div class="devices">
        <div class="text-center title-main"><h2>Выберите ваше устройство</h2></div>
        <?=  app\components\WDevices::widget(['model'=>$model])?>



        <?php if(!empty($title1) && !empty($title2)):?>
            <div class="description-seo">
                <div class="text-center title-main"><h2><?=$title1?></h2></div>
                <div class="text"><?=$description1?></div>
            </div>
            <div class="description-seo">
                <div class="text-center title-main"><h2><?=$title2?></h2></div>
                <div class="text"><?=$description2?></div>
            </div>
        <?php endif; ?>
        <div class="update-devices-problems-list">
            <?=  app\components\WDevicesProblemsList::widget(['model'=>$model])?>
        </div>
    </div>
</div>
