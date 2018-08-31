<?php
/* @var $this yii\web\View */
$this->title = $one->title;

$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1000])->one();

?>

<div class="container size">

    <?=  app\components\WMenuRepairs::widget(['model'=>$model])?>

    <div class="devices">
        <div class="text-center title-main"><h2>Выберите ваше устройство</h2></div>
        <?=  app\components\WDevices::widget(['model'=>$model])?>
        <?php if(!empty($content)): ?>
            <div class="description-seo">
                <div class="text-center title-main"><h2><?=$content->title?></h2></div>
                <div class="text"><?=$content->text?></div>
            </div>
            <div class="description-seo">
                <div class="text-center title-main"><h2><?=$content->title2?></h2></div>
                <div class="text"><?=$content->text2?></div>
            </div>
        <?php endif; ?>
        <?=  app\components\WDevicesProblemsList::widget(['model'=>$model])?>
    </div>
</div>