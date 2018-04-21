<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tajwid_marks".
 *
 * @property integer $id
 * @property integer $grno
 * @property integer $student_id
 * @property integer $class_id
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
class TajwidMarks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tajwid_marks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grno', 'student_id', 'class_id', 'subject_id', 'marks', 'markdate', 'year', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['student_id', 'class_id', 'subject_id', 'marks', 'markdate', 'year'], 'required'],
            [['is_active', 'is_deleted'], 'string'],
            [['subject_id'], 'safe'],
            [['year'], 'safe'],
            
            
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grno' => 'Grno',
            'student_id' => 'Student ID',
            'class_id' => 'Class ID',
            'subject_id' => 'Subject ID',
            'marks' => 'Marks',
            'markdate' => 'Markdate',
            'year' => 'Year',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'i_by' => 'I By',
            'i_date' => 'I Date',
            'u_by' => 'U By',
            'u_date' => 'U Date',
        ];
    }
}
