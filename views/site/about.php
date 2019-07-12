<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse"  data-parent="#accordion" href="#collapseOne">
                    <b class="text-danger">Внимание, Важно</b>
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                Цена, указанная на сайте, предоставляется оптовым покупателям зарегистрированным как "ИП" или "ООО" и является оптовой. Наличие товара можно уточнить по телефонам в офисе фирмы.            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    Я заметил ошибку к кому мне обратиться?
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
                Написать <a href="/contact">сюда</a>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree1">
                    Для чего необходима регистрация на сайте reminsk.ru?
                </a>
            </h4>
        </div>
        <div id="collapseThree1" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Регистрация на сайте - необходимая процедура для всех клиентов желающих приобрести товар. После регистрации Вы получите доступ к возможности отправить заказ, просмотреть статус выполнения заказа.</p>

                <p><b class="text-danger">Обратите внимание.</b> Предоставление заведомо ложных данных при регистрации недопустимо и в дальнейшем может привести к отказу работы с клиентом, либо приостановке работы с ним, на период времени, необходимый для уточнения данных. </p>           </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree2">
                    Условия отправки и оплаты
                </a>
            </h4>
        </div>
        <div id="collapseThree2" class="panel-collapse collapse">
            <div class="panel-body">
                После получения заказа, заявка обрабатывается, затем выставляется счет на оплату. Счет выставляется <b>без учета НДС и действителен в течение 3-х банковских дней, </b> затем заявка аннулируется. Оплатить товар можно по безналичному расчету. После получения оплаты, товар отправляется транспортной компанией выбранной покупателем, либо фирмой поставщика, предварительно обговорив это с покупателем. Оплату услуг транспортной компании покупатель осуществляет самостоятельно.
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree3">
                    Как я могу сделать заказ?
                </a>
            </h4>
        </div>
        <div id="collapseThree3" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Для того что бы сделать и отправить нам заказ необходимо пройти процедуру регистрации, либо скачать прайс лист с нашего сайта, указать в нем на против названия товара необходимое количество, сохранить полученный файл и отправить его нам по любому из почтовых адресов указанных в контактной информации.</p>

                <p>Обратите внимание: минимальная сумма заказа для отправки должна быть не менее 3000 р.</p>            </div>
        </div>
    </div>
</div>
