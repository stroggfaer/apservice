<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Functions extends Model
{

    // Проверка файл;
    public static function fileDir($file = false){

        if(!empty($file) && file_exists(Yii::getAlias('@app').$file.'.php')){
            return true;
        }else{
            return false;
        }
    }

    // Генерация sms-код
    public static function codeSms($phone) {
        if(!empty($phone)) {
            $num = '';
            // Цикл цифры разбиваем на число в виде массивов;
            for ($i = 0; $i < strlen($phone); $i++) {
                $out[$i] = $phone[$i];
                $num = array_slice($out, 1);
            }
            $code = array_sum($num) * 147;
            return substr($code, 0, 4);
        }else{
            return false;
        }
    }
    // Разбиваем Массив c строки;
    public static function getExplode($data,$str = ',') {
        if(empty($data)) return false;
        $array = array();
        $data = explode($str,$data);
        foreach($data as $item) {
            if (!empty($item)) $array[] = $item;
        }
        return $array;
    }

    public static function user($string,$type=false)
    {
        // Обработка данные;
        $string = trim($string);
        $string = rtrim($string, "!,.-");
        if($type) {
            // Выводить только имя;
            $string = preg_replace('#(.*)\s+(.*).*\s+(.*).*#usi', '$2', $string);
        }else{
            $string = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $string);
        }
        return $string;
    }

    // Обработка телефон;
    public static function phone($phone,$type = true)
    {
        if($type) {
            return preg_replace('/(\()|(\))|(-)|(\s)|(^8)/', '', $phone);
        }else{
            return preg_replace('/(\+7)|(\()|(\))|(-)|(\s)|(^8)/', '', $phone);
        }
    }

    // Добавить плюс +7
    public static function phone_is($phone,$type = false)
    {
        if(!empty($type)) {
            $phone = '+7' . substr($phone, -10);
        }else{
            $phone = substr($phone, -10);
        }
        return $phone;
    }
    // Обработка срезаем запятую цены;
    public static function money($value, $decimal = 0)
    {
        return number_format($value, $decimal, '.', ' ');
    }

    public static function txtLogs($obj, $model){
        $file = "----------------------------------------------------\n------------------------START-----------------------\n";
        $fileName =  $model.'_'.time().'_'.rand(0, 1000).'.txt';
        $file.=  time(). '--'.Date('Y.m.d H:i:s'."\n", time()). "\n";
        $file.= var_export($obj, true);
        $dirName =$_SERVER['DOCUMENT_ROOT'] . '/logs/errors/'.Date('Y-m-d', time());
        if(!file_exists($dirName)){
            mkdir($dirName);
        }
        file_put_contents($dirName.'/'.$fileName, $file."\n");
    }

    // Путь к файлу;
    public static function pathFile($path= false) {
        return $_SERVER['DOCUMENT_ROOT'].'/repair/web/files'.$path;
    }
    // Проверка изображения;
    public static function imgPath($dir, $dev = false) {

        if(!empty($dev)) return $dev.'/repair/files'.$dir;
        //
        if(!empty($dir) && file_exists(self::pathFile($dir))) {
            return '/repair/files'.$dir;
        }
        return false;
    }
    // Удаление файлов;
    public static function fDelete($dir, $files) {
        if (is_array($files)) {
            foreach ($files as $file) {
                if (file_exists($dir.$file)) unlink($dir.$file);
            }
        } else {
            if (file_exists($dir.$files)) unlink($dir.$files);
        }
    }
    // Удлаение по одному;
    public static function fDeleteOne($dir) {
        if (!empty($dir) && file_exists($dir)) unlink($dir);
    }
    // Директория фотографии;
    public static function photoDir($photo_id,$type = false) {
        if(!empty($type)) {
            return substr(md5($photo_id), 0, 2);
        }else {
            return substr(md5($photo_id), 0, 2) . '/' . $photo_id;
        }
    }

    // Функция PHP для получения субдомена URL-адреса;
    public static function subDomain($url = false) {
        if(empty($url)) return false;
        $http = empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off' ? 'https://' : 'http://';
        $parsedUrl = parse_url($http.$url);
        $host = explode('.', $parsedUrl['host']);
        return $subdomain = $host[0];
    }

    // Добавляем окончание строки;
    public static function strEnd($text,$str = 'е') {
          return preg_replace("/$/", $str, $text);
    }

    // Шаблоный сео;
    public static function getTemplateCode($string,$device_id = false, $device_problems_id = false) {
        $regex = "/\{(.*?)\}/";
        preg_match_all($regex, $string, $matches);
        $model = new Repair();
        if(!empty($matches[1])) {
            foreach ($matches[1] as $value) {

                switch ($value) {
                    case 'city':
                        $city = \Yii::$app->action->currentCity;
                        //  '/\[([^]]+)\]/'
                        $string = preg_replace('/\{city\}/', $city->name, $string);
                        break;
                    case 'device':
                        //  '/\[([^]]+)\]/'
                        if(!empty($device_id)) {
                            $currentDevices = $model->getCurrentDevices(false, $device_id);
                            $string = preg_replace('/\{device\}/', $currentDevices->title, $string);
                        }else{
                            echo $string;
                        }

                        break;
                    case 'device_problems':
                        //  '/\[([^]]+)\]/'
                        if(!empty($device_problems_id)) {
                            $currentDeviceProblems = $model->getCurrentDeviceProblems(false,$device_problems_id);
                            $string = preg_replace('/\{device_problems\}/', $currentDeviceProblems->title, $string);
                        }else{
                            echo $string;
                        }
                        break;
                }
            }
        }
        return $string;
    }

    // Админ почта;
    public static function getAdminEmail($email=false,$title,$text) {
        $options = Options::findOne(1000);
        $email = !empty($email) ? $email : $options->adminEmail;
        // Отправка писемь
        Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['adminEmail']=>'Форма заявкиAppleService'])
            ->setTo($email)
            ->setSubject($title) // тема письма
            ->setTextBody($text)
            ->setHtmlBody($text)
            ->send();
        return false;
    }

}
