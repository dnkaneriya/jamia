<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school_exam".
 *
 * @property integer $id
 * @property integer $class_id
 * @property integer $subclass_id
 * @property string $standard
 * @property integer $total_mark
 * @property integer $passing_mark
 * @property integer $no_of_semester
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_at
 * @property integer $i_by
 * @property integer $u_at
 * @property integer $u_by
 */
class SchoolExam extends \yii\db\ActiveRecord
{
    public $semester;
    public $semester_mark;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'subclass_id', 'standard', 'total_mark', 'passing_mark', 'no_of_semester'], 'required'],
            [['class_id', 'subclass_id', 'total_mark', 'passing_mark', 'no_of_semester', 'i_at', 'i_by', 'u_at', 'u_by'], 'integer'],
            [['is_active', 'is_deleted'], 'string'],
            [['standard'], 'string', 'max' => 100]
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
            'standard' => Yii::t('app', 'Standard'),
            'total_mark' => Yii::t('app', 'Total Mark'),
            'passing_mark' => Yii::t('app', 'Passing Mark'),
            'no_of_semester' => Yii::t('app', 'No Of Semester'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_at' => Yii::t('app', 'I At'),
            'i_by' => Yii::t('app', 'I By'),
            'u_at' => Yii::t('app', 'U At'),
            'u_by' => Yii::t('app', 'U By'),
        ];
    }
}
