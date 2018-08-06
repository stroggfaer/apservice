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
    public static function phone_is($phone)
    {
        $phone = '+7'.substr($phone, -10);
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
        return $_SERVER['DOCUMENT_ROOT'].'/files'.$path;
    }

    // Директория фотографии;
    public static function photoDir($photo_id,$type = false) {
        if(!empty($type)) {
            return substr(md5($photo_id), 0, 2);
        }else {
            return substr(md5($photo_id), 0, 2) . '/' . $photo_id;
        }
    }

}
