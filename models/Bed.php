<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bed_master".
 *
 * @property integer $id
 * @property string $bed_no
 * @property integer $room_id
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Bed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bed_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bed_no', 'room_id'], 'required'],
            [['room_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['is_active', 'is_deleted'], 'string'],
            [['bed_no'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bed_no' => Yii::t('app', 'Bed No'),
            'room_id' => Yii::t('app', 'Room'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
