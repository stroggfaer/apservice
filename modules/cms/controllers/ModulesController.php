<?php

namespace app\modules\cms\controllers;

use app\models\Functions;
use app\models\Reviews;
use app\modules\cms\models\modules\ParserReviewsGis;
use Yii;
use \yii\base\DynamicModel;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;


class ModulesController extends BackendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @ ParserReviews2gis
     * Парсер отзывы дубль гис;
     */
    public function actionParserReviews2gis() {

      $next = null;
      $limit = 12;

      $api = new ParserReviewsGis();
      $data = $api->getReviewsStatic($limit,$next);

        // Фильтры параметры;
        $model = new DynamicModel(['rating','apple_services']);
        $model->addRule('apple_services','integer')
              ->addRule('rating', 'integer',['max'=>5,'min'=>0]);

        if ($model->load(Yii::$app->request->post())) {
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            //
            if(!empty($data['meta']['org_reviews_count']) && $data['meta']['org_reviews_count'] > 0) {
                return $response->data = [
                    'form'=>[
                        'rating'=> !empty($model->rating) ? $model->rating : null,
                        'apple_services'=> !empty($model->apple_services) ? $model->apple_services : null,
                        'runParser'=>true
                    ],
                    'success'=>'true'
                ];
            }
            return false;
        }

        // Загрузка данные;
        if (!empty(Yii::$app->request->post('runParser'))) {
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;

            $next = Yii::$app->request->post('next_link');
            if(!empty($next)) {
                $data = $api->getReviewsStatic($limit, $next);
            }
            if(!empty($data['meta']['org_reviews_count']) && $data['meta']['org_reviews_count'] > 0) {

                $counter = !empty(Yii::$app->request->post('counter')) ? Yii::$app->request->post('counter') : $data['meta']['org_reviews_count'];

                $apple_services = (int) Yii::$app->request->post('apple_services');
                $rating = (int) Yii::$app->request->post('rating');
                $counters = $counter -= $limit;
                $_rating = !empty($rating) ? $rating : 0;

                if($counters >= 0) {

                    $counts_result = 0;
                    // тут логик;
                    if(!empty($data['reviews'])) {
                      //  photo_preview_urls
                        foreach ($data['reviews'] as $key=>$reviews) {
                            $is_Reviews =  Reviews::find()->where(['gis_id'=>$reviews['id']])->limit(1)->count();
                            if(empty($is_Reviews)) {
                                $review = new Reviews();
                                $review->name = $reviews['user']['name'];
                                $review->text = $reviews['text'];
                                $review->rating = $reviews['rating'];
                                $review->gis_id = $reviews['id'];
                                $review->date_created = date('Y-m-d H:i:s',strtotime($reviews['date_created']));
                                $review->status = 1;
                                if ($_rating <= $reviews['rating']) {
                                    if ($review->save(true)) {
                                        $counts_result++;
                                        $newfile = Functions::pathFile('/review/') . $review->id . '.jpg';
                                        $file = $reviews['user']['photo_preview_urls']['64x64'];
                                        if (!empty($file)) copy($file, $newfile);
                                    }
                                }
                            }
                        }
                    }

                    return $response->data = [
                        'params' => [
                            'limit' => $limit,
                            'counts' => $data['meta']['org_reviews_count'],
                            'counter' => $counters,
                            'counts_result'=> $counts_result,
                            'next_link'=> $data['meta']['next_link']
                        ],
                        'form' => [
                            'rating' => $_rating,
                            'apple_services' => !empty($apple_services) ? $apple_services : null,
                            'runParser' => true
                        ],
                    ];

                }else{
                    return $response->data = [
                        'params' => [
                            'limit' => $limit,
                            'counts' => $data['meta']['org_reviews_count'],
                            'counter' => 0,
                        ],
                        'exit'=>1
                    ];
                }
            }
            return false;
        }

        return $this->render('parser-reviews-2gis',[
            'meta'=>$data['meta'],
            'model'=>$model
        ]);

    }



}
