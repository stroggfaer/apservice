<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property int $group_id
 * @property string $hash
 * @property string $exp
 * @property int $main
 * @property int $status
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'main', 'status'], 'integer'],
            [['hash', 'exp'], 'required'],
            [['hash'], 'string', 'max' => 228],
            [['exp'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'hash' => 'Hash',
            'exp' => 'Exp',
            'main' => 'Main',
            'status' => 'Status',
        ];
    }
}
