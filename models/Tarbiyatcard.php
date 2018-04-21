<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tarbiyat_card".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $t_date
 * @property integer $selected_option_id
 * @property integer $tarbiyat_subject_id
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Tarbiyatcard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tarbiyat_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'selected_option', 'tarbiyat_subject_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'safe'],
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
            'student_id' => Yii::t('app', 'Student'),
            't_year' => Yii::t('app', 'Year'),
			't_month' => Yii::t('app', 'Month'),
            'selected_option' => Yii::t('app', 'Option'),
            'tarbiyat_subject_id' => Yii::t('app', 'Tarbiyat Subject'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
