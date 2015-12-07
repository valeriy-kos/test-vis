<?php

namespace backend\models;

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
            [['email', 'name', 'title', 'content', 'created_at'], 'required'],
            [['content'], 'string'],
            [['on_off'], 'integer'],
            [['created_at'], 'safe'],
            [['email', 'name'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'name' => 'Name',
            'title' => 'Title',
            'content' => 'Content',
            'on_off' => 'модератор - показать - скрыть',
            'created_at' => 'дата подачи',
        ];
    }
}
