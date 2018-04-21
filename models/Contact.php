<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact_master".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property integer $datetime
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message'], 'required'],
            [['message'], 'string'],
            [['datetime'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'message' => Yii::t('app', 'Message'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }
}
