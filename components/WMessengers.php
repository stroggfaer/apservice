<?php
namespace app\components;
use app\models\Pages;
use app\models\Socials;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class WMessengers extends Widget{

    public function run()
    {
             $socials =  Socials::find()->where(['type'=>2,'status'=>1])->all();
            ?>
            <?php if(!empty($socials)): ?>
              <?php foreach ($socials as $key=>$social): ?>
                    <?php
                      $end = end($socials)
                   ?>
                    <a href="<?=$social->href?>" class="no_border <?=$end->id == $social->id ? ' margin-right-clear' : ''?>">
                        <i class="<?=$social->icon?>"></i><?=$social->title?>
                    </a>
               <?php endforeach; ?>
            <?php endif; ?>

            <?php


    }
}