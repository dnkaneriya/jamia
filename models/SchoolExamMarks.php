<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school_exam_marks".
 *
 * @property integer $id
 * @property integer $grno
 * @property integer $student_id
 * @property integer $class_id
 * @property integer $subclass_id
 * @property integer $semester_id
 * @property integer $division_id
 * @property integer $subject_id
 * @property integer $marks
 * @property integer $markdate
 * @property integer $year
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class SchoolExamMarks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_exam_marks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grno', 'student_id', 'class_id', 'subclass_id', 'division_id', 'standard_id', 'semester_id', 'subject_id', 'marks', 'markdate', 'year', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['student_id', 'class_id', 'subclass_id', 'semester_id', 'subject_id', 'marks', 'markdate', 'year'], 'required'],
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
            'student_id' => Yii::t('app', 'Student ID'),
            'class_id' => Yii::t('app', 'Class ID'),
            'subclass_id' => Yii::t('app', 'Subclass ID'),
            'division_id' => Yii::t('app', 'Dvision ID'),
            'semester_id' => Yii::t('app', 'Semester ID'),
            'subject_id' => Yii::t('app', 'Subject ID'),
            'marks' => Yii::t('app', 'Marks'),
            'markdate' => Yii::t('app', 'Markdate'),
            'year' => Yii::t('app', 'Year'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
