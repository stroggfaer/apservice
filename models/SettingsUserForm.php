<?php
namespace app\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SettingsUserForm extends Model
{
    const SCENARIO_ADMIN_RULE = 'admin_password'; // Правила для админки;
    const SCENARIO_RESET_PASSWORD_SYSTEMS = 'password_reset_systems'; // Правила для админки;

    public $username;
    public $name;
    public $family_name;
    public $last_name;
    public $birthday;
    public $phone;
    public $email;
    public $password;
    public $password_current;
    public $password_repeat;
    public $policy = true;

    private $user_id;

    public function rules()
    {
        return [
            [['phone','name','email','family_name','birthday'], 'required'],
            [['name', 'family_name', 'last_name'], 'string', 'max' => 68],
            [['phone'], 'string', 'max' => 25],
            [['birthday'], 'safe'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'email','message'=>'Неправильный формат e-mail адреса! '],
            ['email', 'string', 'max' => 255],
            // Смена пароли;
            ['password_current', 'string', 'max' => 30],
            ['password_current', 'validatePasswordCurrent', 'skipOnEmpty'=> false],
            [['password','password_current','password_repeat'], 'string', 'min' => 4],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],

            // Смена пароли  для админки;
            //[['password','password_repeat'], 'required', 'on' => self::SCENARIO_ADMIN_RULE],
            ['password', 'string', 'min' => 4 ,'on' => self::SCENARIO_ADMIN_RULE],
            ['password', 'compare', 'compareAttribute' => 'password_repeat' ,'on' => self::SCENARIO_ADMIN_RULE],

//            // Восстановления пароли системы;
//            ['password', 'string', 'min' => 4 ,'on' => self::SCENARIO_RESET_PASSWORD_SYSTEMS],
//            ['password', 'compare', 'compareAttribute' => 'password_repeat' ,'on' => self::SCENARIO_RESET_PASSWORD_SYSTEMS],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'family_name' => 'Фамилия',
            'last_name' => 'Отчество',
            'birthday' => 'Дата рождения',
            'phone' => 'Телефон',
            'password_current' => 'Текущий пароль',
            'password_repeat' => 'пароль',
            'password' => 'Пароль',
            'email' => 'Email',
        ];
    }




    // Сбросить пароль;
    public function savePassword() {

        $user = $this->userOne;
        if(!empty($this->password) && !empty($this->password_repeat) && !empty($user)) {
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();
            if (!$user->save(true)) {
                $this->addError('password', 'Все поля должны быть заполнены');
            }
        }

        return null;
    }


    public function setUserId($user_id) {
        if(empty($user_id)) return false;
        $this->user_id = $user_id;
    }

    public function getUser() {
        return User::findOne(Yii::$app->user->identity->getId());;
    }

    public function getUserOne() {
        if(empty($this->user_id)) return false;
        return User::findOne($this->user_id);;
    }

    // Кастомный валидация;
    public function validatePasswordCurrent($attribute, $params)
    {
        $password_current = (string)$this->password_current;
        if (!empty($password_current) && !$this->user->validatePassword($password_current)) {
            $this->addError($attribute, 'Не верный пароль ');
        }
    }

}