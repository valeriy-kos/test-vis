<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Guest_Book".
 *
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $title
 * @property string $content
 * @property integer $on_off
 * @property string $created_at
 */
class GuestBook extends \yii\db\ActiveRecord
{
    public $verifyCode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Guest_Book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'name', 'title', 'content','verifyCode'], 'required'],
            [['email'], 'email'],
            [['content'], 'string'],
            [['on_off'], 'integer'],
            [['created_at'], 'safe'],
            [['email', 'name'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 255],
            ['verifyCode', 'captcha','captchaAction'=>'site/captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'name' => 'Имя',
            'title' => 'Заглавие',
            'content' => 'Содержание',
            'on_off' => 'модератор - показать - скрыть',
            'created_at' => 'дата подачи',
            'verifyCode' => 'Verification Code',
        ];
    }
}
