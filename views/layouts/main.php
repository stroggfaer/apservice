<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Pages;
use app\models\Options;
use yii\bootstrap\Modal;
use app\models\City;
AppAsset::register($this);


$menu = Pages::find()->where(['status'=>1])->all();
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();
$cookies = Yii::$app->request->cookies;

$city = \Yii::$app->action->currentCity;

//$data = Yii::$app->geo->getData();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--Modal Оплата-->
<?php Modal::begin(['header' => '<h4></h4>',
    'closeButton' => ['tag' => 'button', 'label' => '&times;'],
    'id' => 'modal-windows',
    // 'size'=>'modal-sm',
]);?>
<?php Modal::end(); ?>

<?php if(!empty($cookies->getValue('city_id'))): ?>
<div id="is_city_one"></div>
<?php endif; ?>

<div class="wrapper">
    <!--Шапка-->
    <div id="header">
        <div class="container size">
            <div class="desktop">
                <a class="logo" href="/">
                    <span></span>
                </a>
                <div class="select-city-menu">
                    <div class="mcs-module">
                        <a class="city geo_position js-city" href="javascript:void(0)" title="Выбрать другой город"><?=$city->name?></a>
                    </div>
                </div>
                <div class="fixed_menu">
                    <div class="slide_menu js-menu">
                        <div class="slide_menu-btn"><span class="slide_menu-btn-two_border"></span>
                            <?=  app\components\WMenuTop::widget()?>
                        </div>
                    </div>
                </div>
                <div class="top_phone  icon-fa">
                    <i class="fa fa-phone white" aria-hidden="true"></i>
                    <a href="tel:+73832393106" class="callibri_phone">+7 (383) 239-31-06</a>
                </div>
            </div>
            <div class="mobile">
                <div class="flex">
                    <div class="fixed_menu">
                        <div class="slide_menu">
                            <div class="slide_menu-btn"><span class="slide_menu-btn-two_border"></span>
                                <?=  app\components\WMenuTop::widget()?>
                            </div>
                        </div>
                    </div>
                    <a class="logo" href="/">
                        <span></span>
                    </a>
                    <div class="top_phone  icon-fa">
                        <a href="tel:+73832393106" class="callibri_phone"><i class="fa fa-phone white" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="menu">
        <div class="container size">
            <?=  app\components\WMenu::widget()?>
            <div class="basket">
                <div class="icon-basket"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div> <!--./Шапка-->
    <!--Content-->
    <div id="center">
        <!--Главная страница-->
        <div class="repair">
            <?=  app\components\WSlides::widget()?>
            <?=$content?>

        </div> <!--./Главная страница-->
    </div> <!--./Content-->

</div>
<div id="footer">
    <div class="container size">
        <!--Десктоп-->
        <div class="desktop">
            <div class="border">
                <div class="custom-menu_in_footer">
                    <ul>
                        <li><a href="/about">О компании</a></li>
                        <li><a href="http://appleservice.us/">Франчайзинг</a></li>
                        <li><a href="/repair">Ремонт</a></li>
                        <li><a href="/apple-shop">Продукция Apple</a></li>
                        <li><a href="/informatsiya">Информация</a></li>
                        <li><a href="/corpotdel">Организациям</a></li>
                        <li><a href="/support">Поддержка</a></li>
                        <li><a href="/accessories">Аксессуары</a></li>
                        <li><a href="/news">Новости</a></li>
                        <li><a href="/vakansii">Вакансии</a></li>
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
                    <h3>Салоны в Новосибирске</h3>
                </div>
                <div class="contacts ">
                    <div class="item">
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                    </div>
                    <div class="item">
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                    </div>
                    <div class="item">
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                        <div class="address"><a href="#" class="dotted">"Универсам"</a></div>
                    </div>

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
                    <div class="item">
                        <div class="name">О компании</div>
                        <div class="i">
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="name">О компании</div>
                        <div class="i">
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="name">О компании</div>
                        <div class="i">
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="name">О компании</div>
                        <div class="i">
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="name">О компании</div>
                        <div class="i">
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
                            <div><a href="#">Информация</a></div>
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
                <div>© 2008-2018 Сервисный центр AppleService  |  ООО Эпплсервис-НСК2 ИНН5401283771</div>
            </div>
        </div> <!--./Мобилка-->
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
