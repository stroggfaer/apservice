<?php
/* @var $this yii\web\View */
use app\models\Options;
use app\models\Functions;
/* @var $this yii\web\View */
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();
$pageTrainer = \app\models\Pages::find()->where(['id'=>1005,'status'=>1])->one();
$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1000])->one();

$title1 = $one->title1 ? $one->title1 : (!empty($content->title) ? $content->title : '');
$title2 = $one->title2 ? $one->title2 : (!empty($content->title2) ? $content->title2 : '');
$description1 = $one->description1 ? $one->description1 : (!empty($content->text) ? $content->text : '');
$description2 = $one->description2 ? $one->description2 : (!empty($content->text2) ? $content->text2 : '');

?>
<?=  app\components\WSlides::widget()?>
<div class="container min-size">
    <?=  app\components\WMenuRepairs::widget(['model'=>$model])?>
</div>
<div class="container-full">
    <div class="container min-size">
        <div class="devices">
            <div class="text-center title-main">
                <div class="seo-title">Выберите модель вашего iPhone или iPad и неисправность</div>
                <div class="m-text">Цены указаны с учетом проведения работ в сервисном центре (деталь + работа)</div>
            </div>
            <?=  app\components\WDevices::widget(['model'=>$model])?>

            <div class="update-devices-problems-list">
                <?=  app\components\WDevicesProblemsList::widget(['model'=>$model])?>
            </div>
        </div>
    </div>

    <div class="bg-master">
       <div class="container min-size">
           <div class="row content-text">
               <div class="col-md-5 col-sm-7">
                   <h2 class="title">Выезд Мастера</h2>
                   <div class="text">
                       <p>Отличная новость, друзья! Быстро и качественно отремонтировать технику «Apple» в Новосибирске стало еще проще!</p>
                       <br>
                       <p>В «AppleService» появилась услуга «Выезд мастера»! Теперь мы можем приехать к вам в любую точку города и починить вашу технику «Apple»! В рамках услуги «Выезд мастера» оказываем все виды модульного ремонта : от замены батареи и дисплея до ремонта кнопки «Home» и других шлейфов!</p>
                   </div>
                   <a class="btn btn-red circle hidden-sm-mod" href="#">Заказать мастера</a>
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
                   <a class="btn btn-red circle" href="#">Заказать мастера</a>
               </div>
           </div>
       </div>
    </div>

    <div class="review">
        <div class="container min-size">
            <div class="title-carousel">
                <h3 class="title-main">Спасибо за ваши отзывы</h3>
                <div class="buttons">
                    <i class="icon-left-arrow js-review-prev" aria-hidden="true"></i>
                    <i class="icon-right-arrow js-review-next" aria-hidden="true"></i>
                </div>
            </div>

            <div class="review-carousel">
                <div class="items">
                    <div class="item">
                        <div class="content">
                            <div class="text">
                                Вырубился телефон на морозе и после этого перестали запускаться приложения, что используют GPS... А после совета техподдержки телефон вообще перестал включаться.) Ребята быстро разобрались, в чем дело, за одно заменил у них аккумулятор, что обошлось дешевле, чем предполагал. С моими жалобами они бы спокойно могли придумать ценник на ремонт в 10 раз больше, т.к. я сам себе поставил диагноз не слишком утешительный.
                            </div>
                            <div class="client">
                                <div class="photo"><img src="/files/review/1001.png" class="circle"></div>
                                <div class="names">
                                    <div class="name">Вячеслав Яковлев</div>
                                    <div class="description">Какая-то приписка о человеке</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div class="text">
                                Вырубился телефон на морозе и после этого перестали запускаться приложения, что используют GPS... А после совета техподдержки телефон вообще перестал включаться.) Ребята быстро разобрались, в чем дело, за одно заменил у них аккумулятор, что обошлось дешевле, чем предполагал.
                            </div>
                            <div class="client">
                                <div class="photo"><img src="/files/review/1001.png" class="circle"></div>
                                <div class="names">
                                    <div class="name">Вячеслав Яковлев</div>
                                    <div class="description">Какая-то приписка о человеке</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div class="text">
                                Вырубился телефон на морозе и после этого перестали запускаться приложения, что используют GPS... А после совета техподдержки телефон вообще перестал включаться.) Ребята быстро разобрались, в чем дело, за одно заменил у них аккумулятор, что обошлось дешевле, чем предполагал. С моими жалобами они бы спокойно могли придумать ценник на ремонт в 10 раз больше, т.к. я сам себе поставил диагноз не слишком утешительный.
                            </div>
                            <div class="client">
                                <div class="photo"><img src="/files/review/1001.png" class="circle"></div>
                                <div class="names">
                                    <div class="name">Вячеслав Яковлев</div>
                                    <div class="description">Какая-то приписка о человеке</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div class="text">
                                Вырубился телефон на морозе и после этого перестали запускаться приложения, что используют GPS... А после совета техподдержки телефон вообще перестал включаться.) Ребята быстро разобрались, в чем дело, за одно заменил у них аккумулятор, что обошлось дешевле, чем предполагал. С моими жалобами они бы спокойно могли придумать ценник на ремонт в 10 раз больше, т.к. я сам себе поставил диагноз не слишком утешительный.
                            </div>
                            <div class="client">
                                <div class="photo"><img src="/files/review/1001.png" class="circle"></div>
                                <div class="names">
                                    <div class="name">Вячеслав Яковлев</div>
                                    <div class="description">Какая-то приписка о человеке</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div class="text">
                                Вырубился телефон на морозе и после этого перестали запускаться приложения, что используют GPS... А после совета техподдержки телефон вообще перестал включаться.) Ребята быстро разобрались, в чем дело, за одно заменил у них аккумулятор, что обошлось дешевле, чем предполагал. С моими жалобами они бы спокойно могли придумать ценник на ремонт в 10 раз больше, т.к. я сам себе поставил диагноз не слишком утешительный.
                            </div>
                            <div class="client">
                                <div class="photo"><img src="/files/review/1001.png" class="circle"></div>
                                <div class="names">
                                    <div class="name">Вячеслав Яковлев</div>
                                    <div class="description">Какая-то приписка о человеке</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>