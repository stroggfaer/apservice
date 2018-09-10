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
         ?>
           <div class="container size">
            <!--Десктоп-->
            <div class="desktop">
                <div class="border">
                    <div class="custom-menu_in_footer">
                        <ul>
                            <?php if(!empty($menuFooter)): ?>
                                <?php foreach ($menuFooter as $value): ?>
                                     <li><a href="<?=$value->url?>"><?=$value->title?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="custom_footerInfo">
                        <div class="footerSocial">
                            <span>Мы в социальных сетях:</span>
                            <div>
                                <a href="https://www.facebook.com/appleservicensk/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://vk.com/appleservicensk" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
                                <a href="https://www.instagram.com/http.apple.sc/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="footerCards">
                            <span>Принимаем:</span>
                            <div class="cardLogo" id="logoVisa"><i class="fa fa-cc-visa" aria-hidden="true"></i></div>
                            <div class="cardLogo" id="logoMastercard"><i class="fa fa-cc-mastercard" aria-hidden="true"></i></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="">
                    <div class="custom-adresses">
                        <h3>Салоны в <?=Functions::strEnd($city->name)?></h3>
                    </div>
                    <div class="contacts">
                        <?php if(empty($city->value)): ?>
                        <div class="item js-footer-menu-toggle">
                            <?php if(!empty($appleServices)): ?>
                               <?php foreach ($appleServices as $appleService): ?>
                                   <div class="address"><a href="<?=$appleService->value?>" class="dotted"><?=$appleService->title?></a></div>
                               <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="clear"></div>
                        </div>
                        <?php else: ?>
                          <h4><?=$city->value?></h4>
                        <?php endif; ?>
                    </div>
                    <div class="copyright">
                        <div>© 2008-2018 Сервисный центр AppleService  |  ООО Эпплсервис-НСК2 ИНН5401283771</div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div><!--./Десктоп-->
            <!--Мобилка-->
            <div class="mobile">
                <div class="menu_bottom__mod">
                    <div class="items">
                        <div class="item js-footer-menu-toggle">
                            <div class="name">О компании</div>
                            <div class="i">
                                <?php if(!empty($menuFooter)): ?>
                                    <?php foreach ($menuFooter as $value): ?>
                                        <div><a href="<?=$value->value?>"><?=$value->title?></a></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="name"><a href="#" class="no_border">Услуги</a></div>
                        </div>
                        <div class="item">
                            <div class="name"><a href="/accessories" class="no_border">Продукция и аксессуары</a></div>
                        </div>
                        <div class="item js-footer-menu-toggle">
                            <div class="name">Салоны в <?=Functions::strEnd($city->name)?></div>
                            <div class="i">
                                <?php if(!empty($appleServices)): ?>
                                    <?php foreach ($appleServices as $appleService): ?>
                                        <div><a href="<?=$appleService->value?>"><?=$appleService->title?></a></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social">
                    <a href="https://www.facebook.com/appleservicensk/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="https://vk.com/appleservicensk" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
                    <a href="https://www.instagram.com/http.apple.sc/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
                <div class="copyright">
                    <div>© 2008-<?=date('Y')?> Сервисный центр AppleService  |  ООО Эпплсервис-НСК2 ИНН5401283771</div>
                </div>
            </div> <!--./Мобилка-->
        </div>
            <?php
        }

}