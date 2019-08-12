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

        if(!empty($this->review)) {
            ?>
            <tr>
                <td class="image center" data-label="">
                    <img src="<?=$this->review->img?>" class="size-2">
                    <div class="name">
                        <?=$this->review->name?>
                        <div class="rating" style="position: relative; height: 18px"><div class="rating-icon rating-<?=$this->review->rating?>"></div></div>
                        <div class="small"><?=!empty($this->review->date_created) ? date('d.m.Y',strtotime($this->review->date_created)).' г.' : date('d.m.Y',strtotime($this->review->date))?> г.</div>
                    </div>
                </td>
                <td class="text-center center">
                    <div class="description"><?=$this->review->text?></div>
                </td>
            </tr>
            <?php
        }else{
            ?>
            <tr>
                <td colspan="2">
                   <div class="text-center">Нет отзывы</div>
                </td>
            </tr>
            <?php
        }
    }
}