<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "division_master".
 *
 * @property integer $id
 * @property string $division
 * @property integer $class_id
 * @property integer $subclass_id
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Division extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'division_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['division', 'class_id', 'subclass_id'], 'required'],
            [['class_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['is_active', 'is_deleted'], 'string'],
            [['division'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'division' => Yii::t('app', 'Division'),
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
