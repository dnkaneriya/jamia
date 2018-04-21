<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_master".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $grno
 * @property string $text
 * @property string $is_approved
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id'], 'required'],
            [['student_id', 'grno', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['text', 'is_approved', 'is_active', 'is_deleted'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'student_id' => Yii::t('app', 'Student ID'),
            'grno' => Yii::t('app', 'Grno'),
            'text' => Yii::t('app', 'Text'),
            'is_approved' => Yii::t('app', 'Is Approved'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
