<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "result_master".
 *
 * @property integer $id
 * @property integer $class_id
 * @property integer $subclass_id
 * @property integer $division_id
 * @property integer $student_id
 * @property string $result
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class ResultMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'result_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['class_id', 'division_id', 'student_id'], 'required'],
            [['class_id', 'subclass_id', 'division_id', 'student_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
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
            'division_id' => Yii::t('app', 'Division ID'),
            'student_id' => Yii::t('app', 'Student ID'),
            'result' => Yii::t('app', 'Result'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }

    public function getClass()
    {
        return $this->hasOne(Classes::className(), ['id' => 'class_id']);
    }

    public function getClassname()
    {
        return $this->class->name;
    }

    public function getSubclass()
    {
        return $this->hasOne(Subclass::className(), ['id' => 'subclass_id']);
    }

    public function getSubclassname()
    {
        return $this->subclass->sub_class;
    }

    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['id' => 'division_id']);
    }

    public function getDivisionname()
    {
        return $this->division->division;
    }

    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    public function getStudentGR()
    {
        return $this->student->grno;
    }
}
