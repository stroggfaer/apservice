<?php
/**
 * Created by PhpStorm.
 * User: Strogg
 * Date: 30.07.2018
 * Time: 21:21
 */
$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1001])->one();

$this->title = $one->title;
?>

<div class="container size">
    <div class="devices-problems">
        <div class="text-center title-main"><h2>Выбрано устройство <?=$one->title?></h2></div>
        <?=  app\components\WDevices::widget(['model'=>$model,'menu'=>true])?>

        <div class="text-center title-main-1"><h2>Выберите проблему на <?=$one->title?></h2></div>


        <?=  app\components\WDevicesProblemsGroups::widget(['model'=>$model])?>

        <div class="default-problems">
            <a href="#" class="black solid">У меня другая проблемы</a>
            <a href="#" class="black solid">У меня несколько проблем</a>
        </div>

    </div>
</div>
<div class="diagnostics">
    <div class="container size">
        <div class="text-left"><h2>Предварительная диагностика</h2></div>
        <div class="form right pull-left">
            <form role="form" class="form__mod">
                <div class="row">
                    <div class="form-group col-md-6 col-xs-6">
                        <label>Укажите устройство:</label>
                        <select class="form-control">
                            <option>---</option>
                            <option>iphone 4</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label>Укажите проблему:</label>
                        <select class="form-control">
                            <option>---</option>
                            <option>Вибро не работает</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="clear"></div>
            <div class="description-warning">
                Внимание! Данная информация является ознакомительной и не гарантирует, что результаты “Предварительной диагностики” могут совпадать с диагностикой вашего устройства в сервисном центре.
            </div>
            <h3 class="title">Разбито стекло</h3>
            <div class="description">
                Замена сенсорного экрана дисплея Замена сенсорного экрана дисплея  Замена сенсорного экрана дисплея Замена сенсорного экрана дисплея
            </div>
        </div>
        <div class="result-content pull-left">
            <div class="content">
                <div class="description-warning">
                    Внимание! Данная информация является ознакомительной и не гарантирует, что результаты “Предварительной диагностики” могут совпадать с диагностикой вашего устройства в сервисном центре.
                </div>
                <div class="title">Предварительный анализ</div>
                <div class="_icon-ap time">20 мин</div>
                <div class="_icon-ap money">1 800 руб.</div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="container size">
    <?php if(!empty($content)): ?>
       <div class="description-seo">
        <div class="text-center title-main"><h2><?=$content->title?></h2></div>
        <div class="text"><?=$content->text?></div>
    </div>
    <?php endif; ?>
    <div class="devices-problems-list">
        <div class="text-center title-main"><h2>Выберите ваше устройство</h2></div>
        <div class="devices__menu devices_carusel desktop">
            <div class="items">
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
                <div class="item"><a href="#">iPhone 6S Plus</a></div>
            </div>
        </div>
        <div class="select__mod mobile">
            <select class="select">
                <option>Ремонт Phone</option>
                <option>Ремонт Phone</option>
                <option>Ремонт Phone</option>
                <option>Ремонт Phone</option>
                <option>Ремонт Phone</option>
                <option>Ремонт Phone</option>
                <option>Ремонт Phone</option>
                <option>Ремонт Phone</option>
            </select>
        </div>
        <div class="table">
            <table class="table">
                <tr>
                    <th>Услуги по ремонту iPhone 6S</th>
                    <th class="text-right" width="120px">Цена выезде</th>
                    <th class="text-right" width="200px">Цена в сервисных центрах</th>
                </tr>
                <tr>
                    <td><a href="#">Замена сеткла</a></td>
                    <td class="text-right">2 350 руб</td>
                    <td class="text-right">от 1350 руб</td>
                </tr>
                <tr>
                    <td><a href="#">Замена сеткла</a></td>
                    <td class="text-right">2 350 руб</td>
                    <td class="text-right">от 1350 руб</td>
                </tr>
                <tr>
                    <td><a href="#">Замена сеткла</a></td>
                    <td class="text-right">2 350 руб</td>
                    <td class="text-right">от 1350 руб</td>
                </tr>
                <tr>
                    <td><a href="#">Замена сеткла</a></td>
                    <td class="text-right">2 350 руб</td>
                    <td class="text-right">от 1350 руб</td>
                </tr>
                <tr>
                    <td><a href="#">Замена сеткла</a></td>
                    <td class="text-right">2 350 руб</td>
                    <td class="text-right">от 1350 руб</td>
                </tr>

            </table>
            <a href="#" class="dotted">Еще услуги</a>
        </div>
    </div>
</div>
<div class="call-form-content">
    <div class="container size">
        <h3 class="text-center">Бесплатная консультация и подбор сервиса</h3>
        <div class="description text-center">Проконсультируем Вас по нашей горячей линии или отправим к Вам мастера </div>
        <form class="form-inline form__mod circle" role="form">
            <div class="form-group">
                <input class="form-control" placeholder="Ваше имя">
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Контактный телефон">
            </div>
            <div class="form-group"><div class="btn btn-blue circle">Жду звонка</div></div>
        </form>
    </div>
</div>






