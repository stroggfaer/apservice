<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $city_id
 * @property string $title
 * @property string $seo_title
 * @property string $keywords
 * @property string $description
 * @property string $anons
 * @property string $text
 * @property string $date_create
 * @property int $type
 * @property string $ext
 * @property int $show
 * @property int $status
 *
 * @property News $city
 * @property News $news
 */
class News extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'type', 'show', 'status'], 'integer'],
            [['title', 'text'], 'required'],
            [['anons', 'text'], 'string'],
            [['date_create'], 'safe'],
            [['title', 'seo_title','url'], 'string', 'max' => 300],
            [['keywords'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 600],
            [['ext'], 'string', 'max' => 40],
            [['imageFile'], 'file',  'extensions' => 'png, jpg, gif'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],

            ///  [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Seo URL'),
            'city_id' => Yii::t('app', 'Выберите город'),
            'title' => Yii::t('app', 'Название'),
            'seo_title' => Yii::t('app', 'Сео Название'),
            'keywords' => Yii::t('app', 'Ключ'),
            'description' => Yii::t('app', 'Описание'),
            'anons' => Yii::t('app', 'Анонс'),
            'text' => Yii::t('app', 'Текст'),
            'date_create' => Yii::t('app', 'Дата создание'),
            'type' => Yii::t('app', 'Тип'),
            'ext'=>Yii::t('app', 'ext'),
            'imageFile'=>Yii::t('app', 'Загрузите превью'),
            'show' => Yii::t('app', 'Показывать главная страница'),
            'status' => Yii::t('app', 'Опубликовать'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(News::className(), ['city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['city_id' => 'id']);
    }

    public function setType($type) {
        $session = Yii::$app->session;
        $session->open();
        if(!empty($type)) {
            return  $_SESSION['type'] = $type;
        }
        unset($_SESSION['type']);
        return false;
    }

    // получить все данные в сессие;
    public function getSessionType() {
        $session = Yii::$app->session;
        if(!empty($session['type']))  return $session['type'];
        return false;
    }


    public function getImages($min = true) {
        if(!empty($min)) {
            $img = Functions::imgPath('/news/' . $this->id . '.' . $this->ext);
        }else{
            $img = Functions::imgPath('/news/' . $this->id . '.' . $this->ext);
        }
        return !empty($img) ? $img : '/files/no_photo.png';
    }
    public function getIsImg() {
        return Functions::isPathFile('/news/'.$this->id.'.'.$this->ext);
    }

    public function getDirImg(){
        return Functions::pathFile('/news/').$this->id.'.'.$this->ext;
    }

    private function objNews() {
      return self::find()->where(['status'=>1])->orderBy('date_create DESC');
    }

    public function getPages() {
        // делаем копию выборки
        $countQuery = clone $this->objNews();
        // подключаем класс Pagination, выводим по 10 пунктов на страницу
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2,'forcePageParam' => false, 'pageSizeParam' => false]);
        return $pages;

    }

    // Загрузка нововстей
    public function getNewsAll($limit = 12) {
        $city = \Yii::$app->action->currentCity;

        if($this->sessionType) {
            return $news = $this->objNews()->andWhere(['type'=>$this->sessionType])->andWhere(['city_id' => $city->id])->orWhere(['is', 'city_id', new \yii\db\Expression('null')])->offset($this->pages->offset)->limit($this->pages->limit)->all();
        }
        return  $news = $this->objNews()->andWhere(['city_id' => $city->id])->orWhere(['is', 'city_id', new \yii\db\Expression('null')])->offset($this->pages->offset)->limit($this->pages->limit)->all();
    }

}
