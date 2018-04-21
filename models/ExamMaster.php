<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exam_master".
 *
 * @property integer $id
 * @property string $name
 * @property integer $total_marks
 * @property integer $passing_marks
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class ExamMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'total_marks', 'passing_marks'], 'required'],
            [['total_marks', 'passing_marks', 'class_upgrade', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['is_active', 'is_deleted'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'total_marks' => Yii::t('app', 'Total Marks'),
            'passing_marks' => Yii::t('app', 'Passing Marks'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
