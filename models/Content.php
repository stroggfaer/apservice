<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "content".
 *
 * @property int $id
 * @property int $group_id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $value
 * @property int $status
 *
 * @property ContentGroups $group
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'status'], 'integer'],
            [['description', 'text','text2'], 'string'],
            [['title','title2'], 'string', 'max' => 60],
            [['value'], 'string', 'max' => 400],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContentGroups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Группы',
            'title' => 'Название',
            'description' => 'Описание',
            'text' => 'Текст1',
            'text1' => 'Текст2',
            'value' => 'Значение',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(ContentGroups::className(), ['id' => 'group_id']);
    }
}
