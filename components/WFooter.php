<?php
namespace app\components;

use app\models\Options;
use app\models\Repair;
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

         ?>

            <!--Десктоп-->
            <div class="border">
                 <div class="container size footer-top">
                    <div class="custom-menu_in_footer">
                        <ul>
                            <?php if(!empty($menuFooter)): ?>
                                <?php foreach ($menuFooter as $menu):?>
                                     <li><a href="<?= (!empty($menu->url) ? $menu->url : $menu->value)?>"><?=$menu->title?></a></li>
                                <?php endforeach; ?>
                                <li><a href="#">Поддержка </a></li>
                                <li><a href="#">Аксессуары</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="custom_footerInfo">
                        <div class="footerSocial">
                            <a href="https://www.facebook.com/appleservicensk/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i><span>facebook</span></a>
                            <a href="https://www.instagram.com/http.apple.sc/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i><span>instagram</span></a>
                            <a href="https://vk.com/appleservicensk" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i><span>vkontakte</span></a>
                        </div>
                        <div class="footerContact">
                          <div class="phone">
                              <a href="tel:<?=$phone?>" class="no_border"><?=$phone?></a>
                          </div>
                           <div class="messengers">
                              <a href="#" class="no_border"><i class="fa fa-whatsapp"></i>WatsApp</a>
                              <a href="#" class="no_border margin-right-clear"><i class="icon-telegram telegram"></i>Telegram</a>
                           </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                 </div>
            </div>
            <div class="container size">
                <div class="custom-address">
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