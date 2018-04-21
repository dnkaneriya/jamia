<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "weight_height".
 *
 * @property integer $id
 * @property integer $weight
 * @property integer $height
 * @property integer $t_year
 * @property integer $t_month
 * @property integer $student_id
 * @property integer $grno
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Weightheight extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    //Added by sandeep thakkar
    public $class_id;
    public $subclass_id;
    public $division_id;
    public $category;

    //End
    public static function tableName() {
        return 'weight_height';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['weight', 'height', 'student_id', 'grno', 'i_by', 'i_date', 'u_by', 'u_date', 't_year', 't_month'], 'safe'], //'date',
            [['t_year','t_month', 'class_id','subclass_id','division_id', 'category'], 'required', 'on' => 'wh_options'],
            [['is_active', 'is_deleted'], 'string'],
            [['class_id'], 'safe'],
            [['subclass_id'], 'safe'],
            [['division_id'], 'safe']
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['wh_options'] = ['t_year', 't_month', 'class_id', 'subclass_id', 'division_id', 'category']; //Scenario Values Only Accepted
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'weight' => Yii::t('app', 'Weight'),
            'height' => Yii::t('app', 'Height'),
            't_year' => Yii::t('app', 'Year'),
            't_month' => Yii::t('app', 'Month'),
            'student_id' => Yii::t('app', 'Student'),
            'class_id' => Yii::t('app', 'Class'),
            'subclass_id' => Yii::t('app', 'SubClass'),
            'division_id' => Yii::t('app', 'Division'),
            'grno' => Yii::t('app', 'GR No.'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }

}
