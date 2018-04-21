<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tajwid_class".
 *
 * @property integer $id
 * @property string $class_name
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class TajwidClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tajwid_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_name', 'class_name_ar'], 'required'],
            [['is_active', 'is_deleted'], 'string'],
            [['i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['class_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'class_name' => Yii::t('app', 'Class Name'),
            'class_name_ar' => Yii::t('app', 'Class Name Arabic'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
