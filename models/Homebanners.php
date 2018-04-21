<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "home_banners".
 *
 * @property integer $id
 * @property string $banner
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Homebanners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home_banners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banner'], 'required'],
            [['is_active', 'is_deleted'], 'string'],
            [['i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['banner'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'banner' => Yii::t('app', 'Banner'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
