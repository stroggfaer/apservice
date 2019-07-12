<?php
namespace app\components\news;

use app\models\Functions;
use yii\base\Widget;
use Yii;
use yii\helpers\StringHelper;

class WNewsType extends Widget{
    public $modelNews;

    public function init() {
        parent::init();
        if ($this->modelNews === null) {
            $this->modelNews = false;
        }
    }


    public function run(){
            ?>
            <div class="devices__com ">
                <div class="items js-type-news">
                    <div class="item  <?=empty($this->modelNews->sessionType) ? 'active' : ''?>"><a href="#">Все</a></div>
                    <?php if(yii::$app->params['typeNews']): ?>
                        <?php foreach (yii::$app->params['typeNews'] as $key=>$type): ?>
                            <?php $classActive = !empty($this->modelNews->sessionType) && $this->modelNews->sessionType == $key ? 'active': '' ?>
                            <div class="item red-hover <?=$classActive?>" data-type="<?=$key?>"><a href="#"><?=$type?></a></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="clear"></div>
            </div>
            <?php

    }
}