<?php
/* @var $this yii\web\View */
use app\models\Options;
use app\models\Functions;
/* @var $this yii\web\View */
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();
$pageTrainer = \app\models\Pages::find()->where(['id'=>1005,'status'=>1])->one();

$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1003])->one();
$titleContent = (!empty($content->title) ? $content->title : '');
$descriptionContent = (!empty($content->description) ? $content->description : '');
$textContent = (!empty($content->text) ? $content->text : '');



?>
<?=  app\components\WSlides::widget()?>
<div class="container min-size">
    <?=  app\components\WMenuRepairs::widget(['model'=>$model])?>
</div>
<div class="container-full">
    <div class="container min-size">
        <div class="devices">
            <div class="text-center title-main">
                <div class="seo-title"><?=Functions::getTemplateCode($titleContent)?></div>
                <div class="m-text"><?=Functions::getTemplateCode($descriptionContent)?></div>
            </div>
            <?=  app\components\WDevices::widget(['model'=>$model])?>

            <div class="update-devices-problems-list">
                <?php if(!empty($one->show_prices)): ?>
                    <?= app\components\WDevicesProblemsPriceList::widget(['model'=>$model])?>
                <?php else: ?>
                    <?=  app\components\WDevicesProblemsList::widget(['model'=>$model])?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="bg-master">
       <div class="container min-size">
           <div class="row content-text">
               <div class="col-md-5 col-sm-7">
                   <h2 class="title">Выезд Мастера</h2>
                   <div class="text">
                       <?=Functions::getTemplateCode($textContent)?>
                   </div>
                   <a class="btn btn-red circle hidden-sm-mod js-call-master" href="#">Заказать мастера</a>
               </div>
               <div class="col-md-7 col-sm-5 i-description">
                  <div class="item icon-icon-clock">
                      <div class="icon-description">
                          Среднее время выездного ремонта<br>
                          30 минут в <br>
                          вашем присутствии.<br>
                      </div>
                  </div>
                   <div class="item icon-icon-scope">
                       <div class="icon-description">
                           Диагностика бесплатно,<br>
                           даже в случае отказа от <br>
                           ремонта.<br>
                       </div>
                   </div>
                   <div class="item icon-icon-security">
                       <div class="icon-description">
                           Гарантия на любой<br>
                           модульный ремонт <br>
                           до 1 года.<br>
                       </div>
                   </div>
               </div>
               <div class="col-xs-12 text-center show-sm-mod">
                   <a class="btn btn-red circle js-call-master" href="#">Заказать мастера</a>
               </div>
           </div>
       </div>
    </div>

    <div class="review">
        <?=  app\components\WReviews::widget()?>
    </div>
</div>