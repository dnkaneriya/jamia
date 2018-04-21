<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quran_master".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $grno
 * @property integer $t_year
 * @property integer $t_month
 * @property integer $para_no
 * @property integer $line_no
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Quran extends \yii\db\ActiveRecord
{
    public $class_id;
    public $subclass_id;
    public $division_id;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quran_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['t_year', 't_month', 'day'], 'required'],
            [['class_id', 'subclass_id', 'division_id'], 'required', 'on' => 'mainform'],
            [['student_id', 'para_no', 'line_no', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'], //'date',
            [['is_active', 'is_deleted','grno','t_month','t_year','day'], 'safe']
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['mainform'] = ['class_id','subclass_id', 'division_id', 't_year', 't_month', 'day'];//Scenario Values Only Accepted
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
            'grno' => Yii::t('app', 'GR No.'),
			'day' => Yii::t('app', 'Day'),
            't_year' => Yii::t('app', 'Year'),
            't_month' => Yii::t('app', 'Month'),
            'para_no' => Yii::t('app', 'Para No'),
            'line_no' => Yii::t('app', 'Line No'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
