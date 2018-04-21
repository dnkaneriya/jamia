<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tajwid_subject".
 *
 * @property integer $id
 * @property string $subject_name
 * @property integer $tajwid_class_id
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class TajwidSubject extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tajwid_subject';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['subject_name'], 'required'],
            [['tajwid_class_id'], 'required', 'message' => "Please Select {attribute}."],
            [['tajwid_class_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['is_active', 'is_deleted'], 'string'],
            [['subject_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject_name' => Yii::t('app', 'Subject Name'),
            'tajwid_class_id' => Yii::t('app', 'Tajwid Class'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }

    public function getTajwid() {
        return $this->hasOne(TajwidClass::className(), ['id' => 'tajwid_class_id']);
    }

    public function getTajwidName() {
        return $this->tajwid->class_name;
    }

}
