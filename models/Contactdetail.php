<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact_detail".
 *
 * @property integer $id
 * @property string $address
 * @property string $phone
 * @property string $email
 */
class Contactdetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'phone', 'email'], 'required'],
            [['address', 'phone', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
        ];
    }
}
