<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school_standard_upgrade".
 *
 * @property integer $id
 * @property integer $standard_id
 * @property integer $upgrade_standard_id
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property string $i_date
 * @property integer $u_by
 * @property string $u_date
 */
class SchoolStandardUpgrade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_standard_upgrade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['standard_id', 'upgrade_standard_id', 'is_active', 'is_deleted', 'i_by', 'u_by'], 'required'],
            [['standard_id', 'upgrade_standard_id', 'i_by', 'u_by'], 'integer'],
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
            'standard_id' => Yii::t('app', 'Standard ID'),
            'upgrade_standard_id' => Yii::t('app', 'Upgrade Standard ID'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
