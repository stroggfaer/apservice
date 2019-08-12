<?php
namespace app\components;
use app\models\Reviews;
use yii\base\Widget;
use app\models\Options;
use Yii;
use app\models\Functions;
use kartik\rating\StarRating;


class WReviewsList extends Widget {

    public $review;

    public function init() {
        parent::init();

    }
    public function run(){

        if(!empty($this->reviews)) {
            ?>
            <tr>
                <td class="image center" data-label="">
                    <img src="<?=$this->reviews->img?>" class="size-2">
                    <div class="name">
                        <?=$this->reviews->name?>
                        <div class="rating" style="position: relative; height: 18px"><div class="rating-icon rating-<?=$this->reviews->rating?>"></div></div>
                        <div class="small"><?=!empty($this->reviews->date_created) ? date('d.m.Y',strtotime($this->reviews->date_created)).' г.' : date('d.m.Y',strtotime($this->reviews->date))?> г.</div>
                    </div>
                </td>
                <td class="text-center center">
                    <div class="description"><?=$this->reviews->text?></div>
                </td>
            </tr>
            <?php
        }else{
            ?>

            <?php
        }
    }
}