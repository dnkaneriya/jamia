<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jamia_image".
 *
 * @property integer $id
 * @property integer $jamia_id
 * @property string $image
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Jamiaimage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jamia_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jamia_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jamia_id' => Yii::t('app', 'Jamia ID'),
            'image' => Yii::t('app', 'Image'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
