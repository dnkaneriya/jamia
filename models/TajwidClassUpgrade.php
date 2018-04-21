<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tajwid_class_upgrade".
 *
 * @property integer $id
 * @property integer $class_id
 * @property integer $upgrade_class_id
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property string $i_date
 * @property integer $u_by
 * @property string $u_date
 */
class TajwidClassUpgrade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tajwid_class_upgrade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'upgrade_class_id'], 'required'],
            [['class_id', 'upgrade_class_id', 'i_by', 'u_by'], 'integer'],
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
            'class_id' => Yii::t('app', 'Class ID'),
            'upgrade_class_id' => Yii::t('app', 'Upgrade Class ID'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
