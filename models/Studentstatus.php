<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_status".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $is_continue
 * @property string $reason
 * @property integer $join_date
 * @property integer $left_date
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Studentstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'join_date', 'left_date'], 'required'],
            [['student_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'], //'join_date', 'left_date',
            [['is_continue', 'is_active', 'is_deleted'], 'string'],
            [['reason'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'student_id' => Yii::t('app', 'Student'),
            'is_continue' => Yii::t('app', 'Is Continue'),
            'reason' => Yii::t('app', 'Reason'),
            'join_date' => Yii::t('app', 'Join Date'),
            'left_date' => Yii::t('app', 'Left Date'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
