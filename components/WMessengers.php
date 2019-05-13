<?php
namespace app\components;
use app\models\Pages;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class WMessengers extends Widget{

    public function run()
    {
            ?>
            <a href="#" class="no_border">
                <i class="fa fa-whatsapp"></i>WatsApp
            </a>
            <a href="#" class="no_border margin-right-clear">
                <i class="icon-telegram telegram"></i>Telegram
            </a>
            <?php


    }
}