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
        return $_SERVER['DOCUMENT_ROOT'].'/web/files'.$path;
    }

    public static function isPathFile($dir= false) {
        if(file_exists(self::pathFile($dir))) {
            return true;
        }
        return false;
    }

    // Проверка изображения;
    public static function imgPath($dir, $dev = false) {

        if(!empty($dev)) return $dev.'/web/files'.$dir.'?'.time();
        //
        if(!empty($dir) && file_exists(self::pathFile($dir))) {
            return '/web/files'.$dir.'?'.time();
        }
        return '/web/files/no_photo.png';
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

    // Убирает http:/s и www. (site.com)
    public static function domain($url) {
        if(empty($url)) return false;
        $output = preg_replace('/^(https?:)?(\/\/)?(www\.)?/', '', $url);
        return trim($output,"/");
    }

    public static function getUri() {
       $uri = parse_url(Yii::$app->request->referrer);
       if(!empty($uri['path'])) {
           return $uri['path'];
       }
       return '/';
    }

    // Добавляем окончание строки;
    public static function strEnd($text,$str = 'е') {
          return preg_replace("/$/", $str, $text);
    }

    // Шаблоный сео;
    public static function getTemplateCode($string, $device_id = false, $device_problems_id = false,$repair=false) {
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
                            if($currentDevices) {
                                $string = preg_replace('/\{device\}/', $currentDevices->title, $string);
                            }

                        }else{
                            //echo $string;
                        }

                    break;
                    case 'repair':
                        //  '/\[([^]]+)\]/'
                        if(!empty($repair_id)) {

                            $currentRepair = $model->getCurrentRepair(false, $repair_id);
                            $string = preg_replace('/\{repair\}/', !empty($currentRepair->short_name) ? $currentRepair->short_name : $currentRepair->title, $string);
                        }else{
                            $currentRepair = $model->getCurrentRepair();
                            $string = preg_replace('/\{repair\}/', !empty($currentRepair->short_name) ? $currentRepair->short_name :$currentRepair->title, $string);
                        }
                        break;
                    case 'device_problems':
                        //  '/\[([^]]+)\]/' ++
						
                        if(!empty($device_problems_id)) {
                            $currentDeviceProblems = $model->getCurrentDeviceProblems(false,$device_problems_id);
                            $string = preg_replace('/\{device_problems\}/', $currentDeviceProblems->title, $string);
                        }else{
							
                            //echo $string;
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
            ->setFrom([Yii::$app->params['adminEmail']=>'Форма заявки Apple Service'])
            ->setTo($email)
            ->setSubject($title) // тема письма
            ->setTextBody($text)
            ->setHtmlBody($text)
            ->send();
        return false;
    }


    // Обрезаем название;
    public static function strResize($text) {
        $array = ['iPhone'];
        return str_replace($array, '', $text);
    }

    // Транслит;
    public static function translit($string, $encoding = 'UTF-8') {
        $rus = array('', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я');
        $eng = array('', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'g', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'shch', '', 'i', '', 'e', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'G', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Shch', '', 'I', '', 'E', 'Yu', 'Ya');
        $length = mb_strlen($string, $encoding);
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $char = mb_substr($string, $i, 1, $encoding);
            if (array_search($char, $eng)) {
                $result .= $char;
            } else {
                if ($position = array_search($char, $rus)) {
                    $result .= $eng[$position];
                } else {
                    $result .= '-';
                }
            }
        }
        $result = preg_replace("/\-+/", "-", $result);
        $result = trim($result, '-');
        return strtolower($result);
    }

    // Вывести дата формат на русском;
    public static function dateFormat($date = null) {
        if(!empty($date)) {
            $currentDate = date("d.m.Y",strtotime($date));
        }else{
            $currentDate = date("d.m.Y");
        }
        $_monthsList = array(".01." => "января", ".02." => "февраля",
            ".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня",
            ".07." => "июля", ".08." => "августа", ".09." => "сентября",
            ".10." => "октября", ".11." => "ноября", ".12." => "декабря");
        $_mD = date(".m.");
        return $currentDate = str_replace($_mD, " ".$_monthsList[$_mD]." ", $currentDate);
    }


    /*----Интерфейс----*/

    /**
     * $type $bool
     */
    public static function htmlCheck($type) {
        return (!empty($type) ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>');
    }

}
