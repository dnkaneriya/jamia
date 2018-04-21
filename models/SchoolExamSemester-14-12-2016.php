<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school_exam_semester".
 *
 * @property integer $id
 * @property integer $class_id
 * @property integer $subclass_id
 * @property string $semester
 * @property integer $semester_marks
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class SchoolExamSemester extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_exam_semester';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'subclass_id', 'semester', 'semester_marks'], 'required'],
            //[['semester_marks'], 'validateMarks'],
            [['class_id', 'semester_marks', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['is_active', 'is_deleted'], 'string'],
            [['semester'], 'string', 'max' => 50]
        ];
    }
    
    /**
     * Validate Semester marks
     */
    public  function validateMarks($semester_marks, $params)
    {
        $total = 100;
//        $query = (new \yii\db\Query())->from('school_exam_semester')->where(['subclass_id' => $this->subclass_id]);
//        $sum = $query->sum('semester_marks');
        $sum = $this->find()->from('school_exam_semester')->where(['subclass_id' => $this->subclass_id])->sum('semester_marks');
        
        $this->addError($semester_marks, "Test");
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'class_id' => Yii::t('app', 'Class ID'),
            'semester' => Yii::t('app', 'Semester'),
            'semester_marks' => Yii::t('app', 'Semester Marks'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
