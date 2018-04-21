<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject_option".
 *
 * @property integer $id
 * @property integer $tarbiyat_subject_id
 * @property string $options
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Subjectoption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject_option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarbiyat_subject_id'], 'required'],
            [['tarbiyat_subject_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['options', 'is_active', 'is_deleted'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tarbiyat_subject_id' => Yii::t('app', 'Tarbiyat Subject'),
            'options' => Yii::t('app', 'Options'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
