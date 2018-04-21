<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class_upgrade_master".
 *
 * @property integer $id
 * @property integer $class_id
 * @property integer $subclass_id
 * @property integer $upgrade_id
 * @property integer $upgrade_subclass_id
 * @property integer $is_active
 * @property integer $is_deleted
 * @property integer $i_by
 * @property integer $i_at
 * @property integer $u_by
 * @property integer $u_at
 */
class ClassUpgradeMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_upgrade_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'subclass_id', 'upgrade_id', 'upgrade_subclass_id'], 'required'],
            [['class_id', 'subclass_id', 'upgrade_id', 'upgrade_subclass_id', 'is_active', 'is_deleted', 'i_by', 'i_at', 'u_by', 'u_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'class_id' => Yii::t('app', 'Previous Class'),
            'subclass_id' => Yii::t('app', 'Prevous Sub Class'),
            'upgrade_id' => Yii::t('app', 'Upgrade Class'),
            'upgrade_subclass_id' => Yii::t('app', 'Upgrade SubClass'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_at' => Yii::t('app', 'I At'),
            'u_by' => Yii::t('app', 'U By'),
            'u_at' => Yii::t('app', 'U At'),
        ];
    }

    public function getClass()
    {
        return $this->hasOne(Classes::className(), ['id' => 'class_id']);
    }

    public function getUpgradeclass()
    {
        return $this->hasOne(Classes::className(), ['id' => 'upgrade_id']);    
    }

    public function getClassName()
    {
        return $this->class->name;
    }

    public function getUpgradeclassName()
    {
        return $this->upgradeclass->name;
    }
}
