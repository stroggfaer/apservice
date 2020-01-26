<?php
namespace app\components;

use app\models\Options;
use app\models\Repair;
use app\models\Socials;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;
use app\models\Functions;
use app\models\Pages;

class WAddressListMenu extends Widget{

    public function run(){
           $city = \Yii::$app->action->currentCity;
           $model = new Repair();
           $appleServices = $model->getAppleServices();
         ?>
        <div class="menu-items">
            <?php if(empty($city->value)): ?>
                <?php if(!empty($appleServices)):?>
                      <?php foreach ($appleServices as $appleService): ?>
                            <div class="item">
                                <a href="<?=(!empty($appleService->url) ? '/services/'.$appleService->url : 'https://apple.sc/contacts')?>" class="title"><?=$appleService->title?></a>
                                <?php if(!empty($appleService->address)): ?>
                                    <div class="address"><?=$appleService->address?></div>
                                <?php endif; ?>
                                <?php if(!empty($appleService->value)): ?>
                                    <div class="value small"><?=$appleService->value?></div>
                                <?php endif; ?>

                                <?php if(!empty($appleService->level)): ?>
                                    <div class="value small"><?=$appleService->level?></div>
                                <?php endif; ?>
                                <?php if(!empty($appleService->metro)): ?>
                                    <div class="metro"><i class="icon-m"></i> <?=$appleService->metro?></div>
                                <?php endif; ?>
                                <?php if(!empty($appleService->phone)): ?>
                                    <div class="phone"><a href="tel:<?=$appleService->phone?>" class="no_border"><?=$appleService->phone?></a></div>
                                <?php endif; ?>
                            </div>
                      <?php endforeach; ?>
                <?php endif; ?>
            <?php else: ?>
                <div class="item">
                    <a class="i font_light" href="#"><?=$city->value?></a>
                </div>
            <?php endif; ?>
        </div>

            <?php
        }

}