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

class WFooter extends Widget{

    public function run(){
           $city = \Yii::$app->action->currentCity;
           $model = new Repair();
           $menuFooter = Pages::menuPagesFooter();

           $appleServices = $model->getAppleServices();
           $options = Options::find()->where(['id'=>1000,'status'=>1])->one();
           $phone= (!empty($city->value) ? $city->value : $city->phone);
           $socials =  Socials::find()->where(['type'=>1,'status'=>1])->all();
         ?>

            <!--Десктоп-->
            <div class="border">
                 <div class="container min-size footer-top">
                    <div class="custom-menu_in_footer">
                        <ul>
                            <?php if(!empty($menuFooter)): ?>
                                <?php foreach ($menuFooter as $menu):?>
                                     <li><a href="<?= (!empty($menu->url) ? $menu->url : $menu->value)?>"><?=$menu->title?></a></li>
                                <?php endforeach; ?>

                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="custom_footerInfo">
                        <div class="footerSocial">
                            <?php if(!empty($socials)): ?>
                                  <?php foreach ($socials as $key=>$social): ?>
                                      <a href="<?=$social->href?>" target="_blank"><i class="<?=$social->icon?>" aria-hidden="true"></i><span><?=$social->title?></span></a>
                                 <?php endforeach; ?>
                             <?php endif; ?>
                        </div>
                        <div class="footerContact">
                          <div class="phone">
                              <a href="tel:<?=$phone?>" class="no_border"><?=$phone?></a>
                          </div>
                           <div class="messengers">
                               <?= \app\components\WMessengers::widget()?>
                           </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                 </div>
            </div>
            <div class="container min-size">
                <div class="title-carousel">
                    <h3>Салоны в <?=Functions::strEnd($city->name)?></h3>
                    <div class="buttons">
                        <i class="icon-left-arrow js-address-prev" aria-hidden="true"></i>
                        <i class="icon-right-arrow js-address-next" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="contacts">
                    <?php if(empty($city->value)): ?>
                    <?php if(!empty($appleServices)):?>
                       <div class="address-carousel">
                          <div class="items">
                               <?php foreach ($appleServices as $appleService): ?>
                                    <div class="item">
                                        <div class="content">
                                           <a href="<?=(!empty($appleService->url) ? $appleService->url : 'https://apple.sc/contacts')?>" class="title"><?=$appleService->title?></a>
                                           <?php if(!empty($appleService->address)): ?>
                                               <div class="address"><?=$appleService->address?></div>
                                           <?php endif; ?>
                                           <?php if(!empty($appleService->value)): ?>
                                               <div class="value text-muted small"><?=$appleService->value?></div>
                                           <?php endif; ?>
                                              <div class="value text-muted small">2 - Этаж</div>
                                           <?php if(!empty($appleService->metro)): ?>
                                               <div class="metro"><i class="icon-m"></i> <?=$appleService->metro?></div>
                                           <?php endif; ?>
                                           <?php if(!empty($appleService->phone)): ?>
                                               <div class="phone"><?=$appleService->phone?></div>
                                           <?php endif; ?>
                                        </div>
                                   </div>
                               <?php endforeach; ?>
                          </div>
                       </div>
                    <?php endif; ?>
                    <?php else: ?>
                        <h4><?=$city->value?></h4>
                    <?php endif; ?>
                </div>
                <div class="copyright">
                    <div class="text-grey">© <?=date('Y')?> Сервисный центр ASX Care <div class="language"><div class="ru">RU</div> </div></div>
                </div>
                <div class="clear"></div>
            </div>
            <?php
        }

}