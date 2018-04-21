<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendance_master".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $grno
 * @property integer $day
 * @property integer $t_month
 * @property integer $t_year
 * @property string $absent
 * @property string $option
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $class_id;
    public $subclass_id;
    public $division_id;
    
    public static function tableName()
    {
        return 'attendance_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['t_year','t_month','day','class_id','subclass_id','division_id'], 'required', 'on' => 'attendance_options'],
            [['student_id', 'grno', 'day', 't_month', 't_year', 'i_by', 'i_date', 'u_by', 'u_date', 'class', 'hostel'], 'safe'],
            [['absent', 'option', 'is_deleted'], 'string']
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['attendance_options'] = ['t_year','t_month','day','class_id','subclass_id','division_id'];//Scenario Values Only Accepted
        return $scenarios;
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
            'day' => Yii::t('app', 'Day'),
            't_month' => Yii::t('app', 'Month'),
            't_year' => Yii::t('app', 'Year'),
            'class_id' => Yii::t('app', 'Class'),
            'subclass_id' => Yii::t('app', 'Subclass'),
            'division_id' => Yii::t('app', 'Division'),
            'absent' => Yii::t('app', 'Absent'),
            'option' => Yii::t('app', 'Option'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
