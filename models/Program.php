<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "program_master".
 *
 * @property integer $id
 * @property string $name
 * @property integer $p_date
 * @property string $grnos
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Program extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'program_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['name', 'grnos','is_deleted','p_date'], 'safe']
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
            'p_date' => Yii::t('app', 'Program Date'),
            'grnos' => Yii::t('app', 'Grnos'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
