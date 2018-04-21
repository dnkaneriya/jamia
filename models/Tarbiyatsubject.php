<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tarbiyat_subject".
 *
 * @property integer $id
 * @property string $subject
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Tarbiyatsubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tarbiyat_subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_en', 'A', 'B', 'C', 'D'], 'required'],
            [['subject_en','subject_ar'], 'safe'],
            [['is_active', 'is_deleted'], 'string'],
            [['i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject_en' => Yii::t('app', 'Subject(In English)'),
            'subject_ar' => Yii::t('app', 'Subject(In Arabic)'),
            'A' => Yii::t('app', 'Grade A'),
            'B' => Yii::t('app', 'Grade B'),
            'C' => Yii::t('app', 'Grade C'),
            'D' => Yii::t('app', 'Grade D'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
