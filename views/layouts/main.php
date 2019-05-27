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
                        <a class="no_border" href="#">Информация</a>
                        <a class="no_border" href="#">О компании</a>
                        <a class="no_border" href="#">Новости</a>
                        <a class="no_border" href="#">Вакансии</a>
                        <a class="no_border" href="#">Франчайзинг</a>
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
                <div class="menu">
                    <?=  app\components\WMenu::widget()?>
                </div>
                <a class="car icon-car" href="#">
                    <div class="count">3</div>
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
