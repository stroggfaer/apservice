<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "call_groups".
 *
 * @property int $id
 * @property string $title
 * @property int $status
 *
 * @property Call[] $calls
 */
class CallGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'call_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 32],
            [['description'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalls()
    {
        return $this->hasMany(Call::className(), ['group_id' => 'id']);
    }
    public function getCallsCounts()
    {
        return $this->hasMany(Call::className(), ['group_id' => 'id'])->where(['status'=>0])->count();
    }
}
