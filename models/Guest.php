<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "guest_master".
 *
 * @property integer $id
 * @property string $full_name
 * @property integer $in_date
 * @property integer $out_date
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Guest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guest_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['is_active', 'is_deleted'], 'string'],
            [['in_date', 'out_date'], 'safe'],
            [['full_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'full_name' => Yii::t('app', 'Full Name'),
            'in_date' => Yii::t('app', 'In Date'),
            'out_date' => Yii::t('app', 'Out Date'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
