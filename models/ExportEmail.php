<?php

namespace app\models;

use yii\base\Model;
use Yii;

class ExportEmail extends Model
{

    public function getCheckUtf8($charset){

        if(empty($charset)) return false;

        if(strtolower($charset) != "utf-8"){

            return false;
        }

        return true;
    }

    public function getConvertToUtf8($in_charset, $str){

        if(empty($in_charset) && empty($str)) return false;
        // CP1251 utf-8
        return iconv(strtolower($in_charset), "utf-8", $str);
    }

    public function getImapTitle($str){

        if(empty($str)) return false;

        $mime = imap_mime_header_decode($str);

        $title = "";

        if(empty($mime)) return false;

        foreach($mime as $key => $m){

            if(!$this->getCheckUtf8($m->charset)){

                $title .= $this->getConvertToUtf8($m->charset, $m->text);
            }else{

                $title .= $m->text;
            }
        }

        return $title;
    }

    public function getRecursiveSearch($structure){

        $encoding = "";

        if($structure->subtype == "HTML" || $structure->type == 0){

            if($structure->parameters[0]->attribute == "charset"){

                $charset = $structure->parameters[0]->value;
            }

            return array(
                "encoding" => $structure->encoding,
                "charset"  => strtolower($charset),
                "subtype"  => $structure->subtype
            );
        }else{

            if(isset($structure->parts[0])){
                return $this->getRecursiveSearch($structure->parts[0]);
            }else{

                if($structure->parameters[0]->attribute == "charset"){

                    $charset = $structure->parameters[0]->value;
                }

                return array(
                    "encoding" => $structure->encoding,
                    "charset"  => strtolower($charset),
                    "subtype"  => $structure->subtype
                );
            }
        }
    }

    public function getStructureEncoding($encoding, $msg_body){

         switch((int) $encoding){

            case 4:
                $body = imap_qprint($msg_body);
                break;

            case 3:
                $body = imap_base64($msg_body);
                break;

            case 2:
                $body = imap_binary($msg_body);
                break;

            case 1:
                $body = imap_8bit($msg_body);
                break;

            case 0:
                $body = $msg_body;
                break;

            default:
                $body = "";
                break;
        }

         return $body;
    }

    public function getAccountEmail() {
        $mail_login = yii::$app->params['mail_upload'];
        if(empty($mail_login['mail_imap']) || empty($mail_login['email']) || empty($mail_login['password'])) return false;
        return $mail_login;
    }
    // Подключение Email поток;
    public function getConnectEmail() {

        // Подключаем;
        $mail_login = $this->accountEmail;

        $connection = imap_open($mail_login['mail_imap'], $mail_login['email'], $mail_login['password']) or die(imap_last_error());

        return $connection;
    }

    public function searchMailbox($counts=1,$options = false) {
        $dataMails = array();
        $dataSearch = array();
        // Подключаем;
        $connection = $this->connectEmail;
        // Поиск писемь;
        $mailsIds = imap_search($connection, 'FROM "noreply@apple.sc"', SE_UID, "UTF-8");
        if (!empty($mailsIds)) {
            $mailsList = ParserEmail::find()->select('uid')->orderBy('id DESC')->asArray()->where(['status' => 1])->column();
            $result = array_diff($mailsIds, $mailsList);
            sort($result);
            $dataMails = array_slice($result, 0, $counts);
        }

        if(!empty($options)) {
            $dataSearch['countsSerach'] = (!empty($mailsIds) ? count($mailsIds) : 0);
            $dataSearch['count'] =   (!empty($result) ? count($result) : 0);
            return $dataSearch;
        }

        return $dataMails;
    }


    // Список данные массив;
    public function getDataListEmail($maxCounts = 1) {
        header("Content-Type: text/html; charset=utf-8");
        $mails_data = array();
        // Подключаем;
        $connection = $this->connectEmail;

        if($connection) {
            // Результат поиска;
            $mailsIds = $this->searchMailbox($maxCounts);

            $mails = imap_fetch_overview($connection, implode(',', $mailsIds), FT_UID);

            //перебираем сообщения
            if (is_array($mails) && count($mails)) {
                foreach ($mails as $obj) {
                    //получаем UID сообщения
                    $message_uid = $obj->uid;
                    $mails_data[$message_uid]["time"] = time($obj->date);
                    $mails_data[$message_uid]["date"] = $obj->date;
                    $mails_data[$message_uid]['to'] = !empty($obj->to) ? $obj->to : 'Нет';
                    $mails_data[$message_uid]["from"] = !empty($obj->from) ? $obj->from : 'Нет';
                    $mails_data[$message_uid]["subject"] = $obj->subject;

                    // Тело письма
                    $msg_body = imap_fetchbody($connection, $message_uid, 1, FT_UID);
                    $client = $this->getParserBody($msg_body);

                    $saveModel = new ParserEmail();
                    $saveModel->uid = $message_uid;
                    $saveModel->date = $obj->date;
                    $saveModel->from_email = !empty($obj->from) ? $obj->from : 'Нет';
                    $saveModel->to_email = !empty($obj->to) ? $obj->to : 'Нет';
                    $saveModel->subject = $obj->subject;
                    $saveModel->name = $client['name'];
                    $saveModel->phone = $client['phone'];
                    $saveModel->email = $client['email'];
                    $saveModel->city = $client['city'];
                    $saveModel->content = $msg_body;
                    $saveModel->save();
                }
            }
            imap_close($connection);
        }

            return $mails_data;


    }



    // Количество писемь;
    public function getCountsEmail() {
        $session = Yii::$app->session;
        $session->open();

        if(empty($session['counts_emal'])) {
            $connection = $this->connectEmail;
            $session['counts_emal'] = imap_num_msg($connection);
        }
        return !empty($session['counts_emal']) ? $session['counts_emal'] : 0;
    }

    // Обработка текст писемь
    public function getParserBody($text = false) {
        if(empty($text)) return false;
        $data = [];
        // Что нужно отсеят;
        $replace_array = array('Заявка на звонок', 'Имя:', 'Телефон:', 'Электронная почта:', 'Город:', 'email:', 'С какой формы поступила заявка: нижняя форма заявки');
        $str = str_replace($replace_array, ",", $text);
        $str = preg_replace('/\s/', '', $str);
        $str = preg_replace('/^[,\s]+|[,\s]+$/', '', $str);
        $exp = explode(',',$str);
        $data['name'] = !empty($exp[0]) ? $exp[0] : 'Нет';
        $data['phone'] = !empty($exp[1]) ? $exp[1] : 'Нет';
        $data['email'] = !empty($exp[2]) ? $exp[2] : 'Нет';
        $data['city'] = !empty($exp[3]) ? $exp[3] : 'Нет';
        return $data;
    }

}
