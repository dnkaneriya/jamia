<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_education".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $madrasa_name
 * @property string $nazra
 * @property string $hifz
 * @property string $arabic
 * @property string $urdu
 * @property integer $nazra_para
 * @property integer $hifz_para
 * @property string $school_name
 * @property string $school_medium
 * @property string $grade
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Studenteducation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'nazra_para', 'hifz_para', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['nazra', 'hifz', 'arabic', 'urdu', 'school_medium'], 'string'],
            [['madrasa_name', 'school_name', 'grade','school_standard'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'student_id' => Yii::t('app', 'Student ID'),
            'madrasa_name' => Yii::t('app', 'Madrasa Name'),
            'nazra' => Yii::t('app', 'Nazra'),
            'hifz' => Yii::t('app', 'Hifz'),
            'arabic' => Yii::t('app', 'Arabic'),
            'urdu' => Yii::t('app', 'Urdu'),
            'nazra_para' => Yii::t('app', 'Nazra Para'),
            'hifz_para' => Yii::t('app', 'Hifz Para'),
            'school_name' => Yii::t('app', 'School Name'),
            'school_standard' => Yii::t('app', 'Standard'),
            'school_medium' => Yii::t('app', 'School Medium'),
            'grade' => Yii::t('app', 'Grade'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
