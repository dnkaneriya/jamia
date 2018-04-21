<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school_exam_result".
 *
 * @property integer $id
 * @property integer $class_id
 * @property integer $subclass_id
 * @property integer $standard_id
 * @property integer $grno
 * @property integer $student_id
 * @property integer $year
 * @property string $result
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class SchoolExamResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_exam_result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'subclass_id', 'standard_id', 'grno', 'student_id', 'year', 'result', 'is_active', 'is_deleted', 'i_by', 'i_date', 'u_by', 'u_date'], 'required'],
            [['class_id', 'subclass_id', 'standard_id', 'grno', 'student_id', 'year', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['result', 'is_active', 'is_deleted'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'class_id' => Yii::t('app', 'Class ID'),
            'subclass_id' => Yii::t('app', 'Subclass ID'),
            'standard_id' => Yii::t('app', 'Standard ID'),
            'grno' => Yii::t('app', 'Grno'),
            'student_id' => Yii::t('app', 'Student ID'),
            'year' => Yii::t('app', 'Year'),
            'result' => Yii::t('app', 'Result'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
