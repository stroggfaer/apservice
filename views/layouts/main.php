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

<?php if(empty($_COOKIE['MCS_CITY_CODE'])): ?>
   <div id="is_city_one"></div>
<?php endif; ?>
<div class="bg-show"></div>
<div class="spinner__mod">
    <div class="loader"></div>
</div>

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
                    <a href="tel:<?=$city->phone?>" class="callibri_phone"><?=$city->phone?></a>
                </div>
            </div>
            <div class="mobile">
                <div class="flex">
                    <div class="fixed_menu">
                        <div class="slide_menu js-menu-mobile">
                            <div class="slide_menu-btn"><span class="slide_menu-btn-two_border"></span></div>
                        </div>
                    </div>
                    <a class="logo" href="/">
                        <span></span>
                    </a>
                    <div class="top_phone  icon-fa">
                        <a href="tel:<?=$city->phone?>" class="callibri_phone"><i class="fa fa-phone white" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="menu">
        <div class="container size">
            <div class="geo mobile">
                <a class="city geo_position js-city" href="javascript:void(0)" title="Выбрать другой город"><?=$city->name?></a>
            </div>
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
    <?=  app\components\WFooter::widget()?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
