<?php

namespace app\models;

use yii\base\Model;
use Yii;

class Api extends Model
{
// Пуш уведомления;
    private $apiUrl = '';
    private $userId = '';
    private $secret = '';
    private $token;

// Регистрация токен;
    private function getToken()
    {
        $data = array(
            'grant_type' => 'client_credentials',
            'client_id' => $this->userId,
            'client_secret' => $this->secret,
        );

        $requestResult = $this->push_static('oauth/access_token', 'POST', $data);

        if (empty($requestResult)) {
            return false;
        }
        $this->token = $requestResult['access_token'];
        return true;
    }

     // Запрос на API;
    function push_static($path, $method = 'GET', $data = array(), $useToken = true)
    {
        // Загрузка данных;
        $ch = curl_init();
        $url = $this->apiUrl . '/' . $path;

        if (!empty($this->token)) {
            $headers = array('Authorization: Bearer ' . $this->token);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
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
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        // Вывод данных;
        if ($result) return $result;

        return false;
    }


// Выводить все Пуши уведомления;
    public function getPushMessage()
    {
        $token = $this->getToken();
        $requestResult = $this->push_static('push/tasks');
        return $requestResult;
    }

// Статистистика;
    public function getPushStatic()
    {
        $id = 4775;
        $data['subscriptions'] = $this->push_static('push/websites/' . $id . '/subscriptions/total');

        return $data;
    }

}
