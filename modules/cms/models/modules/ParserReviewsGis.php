<?php
/**
 * Created by PhpStorm.
 * User: Strogg
 * Date: 07.08.2019
 * Time: 8:32
 */

namespace app\modules\cms\models\modules;
use yii\base\Model;
use Yii;
use yii\helpers\Url;

class ParserReviewsGis extends Model
{
// Пуш уведомления;
    private $apiUrl = 'https://api.reviews.2gis.com/2.0/orgs/141274360175240/reviews?fields=meta.org_rating%2Cmeta.org_reviews_count';


    // Запрос на API;
    private function curlParams($postUrl, $method = 'GET', $data = array(), $useToken = true)
    {
        // Загрузка данных;
        $ch = curl_init();
        $url = $postUrl;

        switch ($method) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, count($data));
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                break;
            default:
                if (!empty($data)) {
                    $url .= '?' . http_build_query($data);
                }
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $result = curl_exec($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        // Вывод данных;
        if ($result) return $result;

        return false;
    }


    // Получить количество отзывы;
    public function getCounts() {
        $data = $this->curlParams($this->apiUrl);
        return $data;
    }


    // Статистистика;
    public function getReviewsStatic($limit,$next = false)
    {
      // https://api.reviews.2gis.com/2.0/orgs/141274360175240/reviews?fields=meta.org_rating%2Cmeta.org_reviews_count&limit=12
    //  $url = 'https://api.reviews.2gis.com/2.0/orgs/141274360175240/reviews?fields=meta.org_rating%2Cmeta.org_reviews_count&limit=12';
     // $dataCount = $this->getCounts();
     // $limit = $dataCount['meta']['org_reviews_count'];
        if($next) {
            $data = $this->curlParams($next);
        }else{
            $data = $this->curlParams($this->apiUrl.'&limit='.$limit);
        }

        return $data;
    }

}

