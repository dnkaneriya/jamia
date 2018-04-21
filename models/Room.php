<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room_master".
 *
 * @property integer $id
 * @property integer $room_no
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_no'], 'required'],
            [['i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
			[['room_no'],'safe'],
            [['is_active', 'is_deleted'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'room_no' => Yii::t('app', 'Room No'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
