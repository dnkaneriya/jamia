<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leave_master".
 *
 * @property integer $id
 * @property integer $staff_id
 * @property integer $type_id
 * @property string $reason
 * @property integer $leave_date
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Leave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['staff_id', 'type_id', 'leave_date'], 'required'],
            [['staff_id', 'type_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
			[['reason', 'is_active', 'is_deleted','staff_cat_id', 'leave_date'], 'safe'],
            [['reason', 'is_active', 'is_deleted'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
			'staff_cat_id' => Yii::t('app', 'Staff Category'),
            'staff_id' => Yii::t('app', 'Staff'),
            'type_id' => Yii::t('app', 'Leave Type'),
            'reason' => Yii::t('app', 'Reason'),
            'leave_date' => Yii::t('app', 'Leave Date'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
