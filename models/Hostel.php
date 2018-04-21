<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hostel_master".
 *
 * @property integer $id
 * @property integer $grno
 * @property integer $student_id
 * @property integer $room_id
 * @property integer $bed_id
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Hostel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hostel_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grno', 'student_id', 'room_id', 'is_monitor', 'bed_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'safe'],
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
            'grno' => Yii::t('app', 'Grno'),
            'student_id' => Yii::t('app', 'Student'),
            'room_id' => Yii::t('app', 'Room'),
            'bed_id' => Yii::t('app', 'Bed'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
