<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school_subject".
 *
 * @property integer $id
 * @property string $name_en
 * @property string $name_ar
 * @property integer $class_id
 * @property integer $subclass_id
 * @property integer $semester_id
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class SchoolSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_en', 'class_id', 'semester_id', 'name_en', 'name_ar'], 'required'],
            [['class_id', 'subclass_id', 'semester_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['is_active', 'is_deleted'], 'string'],
            [['name_en', 'name_ar'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_en' => Yii::t('app', 'Name En'),
            'name_ar' => Yii::t('app', 'Name Ar'),
            'class_id' => Yii::t('app', 'Class ID'),
            'subclass_id' => Yii::t('app', 'Subclass ID'),
            'semester_id' => Yii::t('app', 'Semester ID'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
