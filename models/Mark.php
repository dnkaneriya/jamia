<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marks_master".
 *
 * @property integer $id
 * @property integer $grno
 * @property integer $student_id
 * @property integer $class_id
 * @property integer $subclass_id
 * @property integer $division_id
 * @property integer $subject_id
 * @property integer $marks
 * @property integer $markdate
 * @property integer $exam_id
 * @property integer $year
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Mark extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marks_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'marks'], 'required'],
            [['year', 'exam_id', 'class_id','subclass_id','division_id','subject_id'], 'required', 'on' => 'marks_options'],
            [['student_id', 'exam_id', 'year'], 'integer'],
            [['student_id', 'class_id', 'subject_id', 'subclass_id', 'division_id', 'marks', 'markdate', 'exam_id', 'year'], 'safe'],
            [['is_active', 'is_deleted'], 'string']
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['marks_options'] = ['year', 'exam_id', 'class_id','subclass_id','division_id','subject_id'];//Scenario Values Only Accepted
        return $scenarios;
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
            'class_id' => Yii::t('app', 'Class'),
            'subclass_id' => Yii::t('app', 'Subclass'),
            'division_id' => Yii::t('app', 'Division'),
            'subject_id' => Yii::t('app', 'Subject'),
            'marks' => Yii::t('app', 'Marks'),
            'markdate' => Yii::t('app', 'Date'),
            'exam_id' => Yii::t('app', 'Exam ID'),
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
