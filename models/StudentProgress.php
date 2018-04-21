<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_progress".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $grno
 * @property integer $year
 * @property integer $month
 * @property integer $class_id
 * @property integer $subclass_id
 * @property integer $category
 * @property integer $subject_id
 * @property double $rating
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property string $i_date
 * @property integer $u_by
 * @property string $u_date
 */
class StudentProgress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_progress';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'grno', 'year', 'month', 'class_id', 'subclass_id', 'category', 'subject_id', 'rating', 'is_active', 'is_deleted', 'i_by', 'u_by'], 'required'],
            [['student_id', 'grno', 'year', 'month', 'class_id', 'subclass_id', 'category', 'subject_id', 'i_by', 'u_by'], 'integer'],
            [['rating'], 'number'],
            [['is_active', 'is_deleted'], 'string'],
            [['i_date', 'u_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'student_id' => Yii::t('app', 'Student ID'),
            'grno' => Yii::t('app', 'Grno'),
            'year' => Yii::t('app', 'Year'),
            'month' => Yii::t('app', 'Month'),
            'class_id' => Yii::t('app', 'Class ID'),
            'subclass_id' => Yii::t('app', 'Subclass ID'),
            'category' => Yii::t('app', 'Category'),
            'subject_id' => Yii::t('app', 'Subject ID'),
            'rating' => Yii::t('app', 'Rating'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
