<?php

namespace app\components\modal;

use app\models\Functions;
use yii\base\Widget;
use Yii;

class WContentProblemsList extends Widget{
    public $repair ,$device_problems_id;

    public function run(){
            if(!empty($this->device_problems_id)) {
                   $currentDeviceProblems =  $this->repair->getCurrentDeviceProblems(false,$this->device_problems_id);
                   if(empty($currentDeviceProblems)) return 'no info';
                ?>
                 <div class="items">
                     <div class="pull-left result-content">
                         <div class="title"><?=$currentDeviceProblems->title?></div>
                         <div class="description"><?=$currentDeviceProblems->description?></div>
                     </div>
                     <div class="result-content pull-right ">
                             <div class="content">
                                 <?php if(!empty($currentDeviceProblems->time)): ?>
                                     <div class="icon-clock time"><span class="i"><?=$currentDeviceProblems->time?></span></div>
                                 <?php endif; ?>
                                 <?php if(!empty($currentDeviceProblems->price->money)): ?>
                                     <div class="icon-wallet money"><span class="i"><?=Functions::money($currentDeviceProblems->price->money)?><span class="rub">р.</span></span></div>
                                 <?php endif; ?>
                             </div>
                     </div>
                     <div class="clear"></div>
                     <div class="description-warning"><?=Yii::$app->params['text_diagnostics']?></div>
                 </div>
                <?php
            }
        }

}