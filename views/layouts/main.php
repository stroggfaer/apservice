<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Pages;
use app\models\Options;
use yii\bootstrap\Modal;
use app\models\Functions;
use app\models\City;

AppAsset::register($this);


$options = Options::find()->where(['id'=>1000,'status'=>1])->one();
$city = \Yii::$app->action->currentCity;

//print_arr($options);
//$data = Yii::$app->geo->getData();

if(Functions::domain($options->url)) {
    $domain = '.'.Functions::domain($options->url);
    $jsScript = "
         jQuery(document).ready(function () { 
                var domain_city = '".$domain."'; // apple.sc
                 // Заопмним город;
                $(document).one('click','.js-city-one',function () {
                    var domain = $(this).data('domen');       
                     console.log(domain);
                    //
                    $.cookie('MCS_CITY_CODE', domain, {
                        domain: domain_city,
                        path: '/'
                    });
                    console.log('domain',domain_city);
                });
                              // Закрыть модалка;
                $('#window-modal').on('hidden.bs.modal', function (e) {
                    if($('#city-modal').length) {
                        var domain_city = '".$domain."'; // apple.sc
                        var domain = $('#city-modal').data('domen');
                       $.cookie('MCS_CITY_CODE', domain, {
                            domain: domain_city,
                            path: '/'
                        });
                    }
                });

         })";

    if(empty(\Yii::$app->action->domainCookie) ) {
        $__jsScript = "
         jQuery(document).ready(function () { 
                // Запрос на геолокаций;
                $(window).on('load', function () {
                   console.log('GEO');
                    $('.js-city').click();
                });
         });";
        $this->registerJs($__jsScript);
    }
    $this->registerJs($jsScript);
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/manifest.json">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--Modal Оплата-->
<?php Modal::begin(['header' => '<h4></h4>',
    'closeButton' => ['tag' => 'button', 'label' => '&times;'],
    'id' => 'window-modal',
    // 'size'=>'modal-sm',
]);?>
<?php Modal::end(); ?>

<?php if(empty($_COOKIE['MCS_CITY_CODE']) && !empty($city->url)): ?>
   <div id="is_city_one"></div>
<?php endif; ?>
<div class="bg-show"></div>
<div class="spinner__mod">
    <div class="loader"></div>
</div>

<div class="wrapper">
    <!--Шапка-->
    <div id="header">
        <div class="top-header">
            <div class="container size ">
                <div class="flex">
                    <div class="city icon-fa">
                        <a href="javascript:void(0)" class="js-city font_light" title="Выбрать другой город"><?=$city->name?> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    </div>
                    <div class="menu-top">
                        <?= app\components\WMenuTop::widget()?>
                    </div>
                    <div class="messengers">
                        <?= app\components\WMessengers::widget()?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container size">
            <div class="header-bottom">
                <div class="logo-top">
                    <a class="logo no_border" href="/">
                        <img src="/images/logo1x.png" alt="" />
                        <span class="description">сервисный центр по ремонту техники Apple</span>
                    </a>
                </div>
                <a href="https://apple.sc/" class="logo-h">
                    <img src="/images/logo-h.png" alt="" />
                </a>
                <div class="menu">
                    <?=  app\components\WMenu::widget()?>
                </div>
                <a class="car icon-car" target="_blank" href="https://apple.sc/accessories">
                    <div class="count hidden">3</div>
                </a>
                <div class="fixed_menu">
                    <div class="slide_menu js-menu-mobile">
                        <div class="slide_menu-btn"><span class="slide_menu-btn-two_border"></span></div>
                    </div>
                </div>
                <div class="top_phone ">
                    <?php $phone_top = (!empty($city->value) ? $city->value : $city->phone); ?>
                    <a href="tel::<?=$phone_top?>" class="callibri_phone"><?=$phone_top?></a>
                </div>
            </div>
        </div>
    </div>

    <!--Меню моб. версия-->
    <div id="menu-mobile">
        <div class="menu-content">
            <div class="container size">
                <div class="label-header">

                </div>
                <?=  app\components\WMenuMobile::widget()?>
                <div class="label-footer">
                    <div class="city icon-fa">
                        <a href="javascript:void(0)" class="js-city no_border" title="Выбрать другой город"><?=$city->name?> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    </div>
                    <a href="tel::<?=$phone_top?>" class="phone no_border"><?=$phone_top?></a>
                    <div class="messengers">
                        <?= app\components\WMessengers::widget()?>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--./Меню моб. версия-->
    <?php
       $classCenter = in_array(Yii::$app->controller->id,yii::$app->params['controller']) ? '' : 'grey';
    ?>
    <!--Content-->
    <div id="center" class="<?=$classCenter?>">
        <div class="container min-size">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </div>
        <!--Главная страница-->
        <div class="repair">

            <?=$content?>

        </div> <!--./Главная страница-->
    </div> <!--./Content-->
</div>


<div id="footer">
    <?=  app\components\WFooter::widget()?>
</div>
<?php if(true): ?>
<?=  app\components\WHtml::widget()?>
<?php endif; ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
