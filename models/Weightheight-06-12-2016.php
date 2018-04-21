<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "weight_height".
 *
 * @property integer $id
 * @property integer $weight
 * @property integer $height
 * @property integer $date
 * @property integer $student_id
 * @property integer $class_id
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Weightheight extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weight_height';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weight', 'height', 'student_id', 'class_id'], 'required'], //'date',
            [['weight', 'height', 'student_id', 'class_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'], //'date',
            [['is_active', 'is_deleted'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'weight' => Yii::t('app', 'Weight'),
            'height' => Yii::t('app', 'Height'),
            'date' => Yii::t('app', 'Date'),
            'student_id' => Yii::t('app', 'Student'),
            'class_id' => Yii::t('app', 'Class'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
