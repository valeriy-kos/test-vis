<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Firms".
 *
 * @property integer $id
 * @property string $Name
 */
class Firms extends \yii\db\ActiveRecord
{
    public $pPhone;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Firms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'pPhone' => 'Телефон'
        ];
    }
}
