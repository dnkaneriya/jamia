<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "setting_master".
 *
 * @property integer $id
 * @property string $setting_key
 * @property string $setting_value
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active'], 'string'],
            //[['i_by', 'i_date', 'u_by', 'u_date'], 'required'],
            [['i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['setting_key'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'setting_key' => Yii::t('app', 'Setting Key'),
            'is_active' => Yii::t('app', 'Is Active'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
