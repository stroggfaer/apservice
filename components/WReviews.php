<?php
namespace app\components;
use app\models\Reviews;
use yii\base\Widget;
use app\models\Options;
use Yii;
use app\models\Functions;
use kartik\rating\StarRating;


class WReviews extends Widget {

    public function init() {
        parent::init();

    }
    public function run(){
        $reviews = Reviews::find()->where(['status'=>1,'show'=>1])->limit(20)->all();
        if(!empty($reviews)) {
            ?>
            <div class="container min-size">
                <div class="title-carousel">
                    <h3 class="title-main"><a href="/reviews/">Спасибо за ваши отзывы</a></h3>
                    <div class="buttons">
                        <i class="icon-left-arrow js-review-prev" aria-hidden="true"></i>
                        <i class="icon-right-arrow js-review-next" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="review-carousel">
                    <div class="items">
                        <?php foreach ($reviews as $review): ?>
                            <div class="item">
                                <div class="content">
                                    <div class="text"><?=$review->text?></div>
                                    <div class="client">
                                        <div class="photo"><img src="<?=$review->img?>" class="circle size-2 crop"></div>
                                        <div class="names">
                                            <div class="name"><?=$review->name?></div>
                                           <?php if(!empty($review->description)): ?>
                                                 <div class="description"><?=$review->description?></div>
                                           <?php endif; ?>
                                            <?php if(!empty($review->rating)): ?>
                                                <div class="rating"><div class="rating-icon rating-<?=$review->rating?>"></div></div>
                                            <?php endif; ?>
                                            <div class="date"><?=!empty($review->date_created) ? date('d.m.Y',strtotime($review->date_created)) : date('d.m.Y',strtotime($review->date))?> г.</div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}