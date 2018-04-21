<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "complaint_master".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $grno
 * @property string $content
 * @property integer $date
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Complaint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complaint_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'c_date'], 'required'],
            [['student_id', 'grno', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['content', 'is_active', 'is_deleted'], 'string']
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
            'grno' => Yii::t('app', 'Grno'),
            'content' => Yii::t('app', 'Content'),
            'c_date' => Yii::t('app', 'Date'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
