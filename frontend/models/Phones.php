<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Phones".
 *
 * @property integer $phone_id
 * @property integer $FirmID
 * @property string $Phone
 */
class Phones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Phones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FirmID'], 'required'],
            [['FirmID'], 'integer'],
            [['Phone'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone_id' => 'Phone ID',
            'FirmID' => 'Firm ID',
            'Phone' => 'Phone',
        ];
    }
}
