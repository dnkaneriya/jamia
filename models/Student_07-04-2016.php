<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_master".
 *
 * @property integer $id
 * @property integer $grno
 * @property string $name_en
 * @property string $name_ar
 * @property string $address
 * @property string $city
 * @property string $state
 * @property integer $dob
 * @property string $contact_no
 * @property string $fees
 * @property integer $amount
 * @property integer $date
 * @property string $email
 * @property string $mother_name
 * @property string $father_name
 * @property string $grandfather_name
 * @property string $parent_mobile
 * @property string $parent_occupation
 * @property string $parent_income
 * @property string $is_continue
 * @property string $is_selected
 * @property integer $divison_id
 * @property integer $class_id
 * @property integer $sub_class_id
 * @property string $image
 * @property string $bloodgroup
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grno', 'amount', 'divison_id', 'class_id', 'sub_class_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'], //'dob', 'date',
            [['name_en', 'parent_mobile'], 'required'],
            [['fees', 'is_continue', 'is_selected', 'is_active', 'is_deleted','surname_en','lastname_en'], 'string'],
            [['register_status','how_old'],'safe'],
            [['name_en', 'name_ar', 'address', 'city', 'state', 'contact_no', 'email', 'mother_name', 'father_name', 'grandfather_name', 'parent_mobile', 'parent_occupation', 'parent_income', 'image', 'bloodgroup'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'grno' => Yii::t('app', 'Grno'),
            'name_en' => Yii::t('app', 'Name (English)'),
            'name_ar' => Yii::t('app', 'Name (Arabic)'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'dob' => Yii::t('app', 'Date of Birth'),
            'contact_no' => Yii::t('app', 'Contact No'),
            'fees' => Yii::t('app', 'Fees'),
            'amount' => Yii::t('app', 'Amount'),
            'date' => Yii::t('app', 'Date'),
            'email' => Yii::t('app', 'Email'),
            'mother_name' => Yii::t('app', 'Mother Name'),
            'father_name' => Yii::t('app', 'Father Name'),
            'grandfather_name' => Yii::t('app', 'Grandfather Name'),
            'parent_mobile' => Yii::t('app', 'Parent Mobile'),
            'parent_occupation' => Yii::t('app', 'Parent Occupation'),
            'parent_income' => Yii::t('app', 'Parent Income'),
            'is_continue' => Yii::t('app', 'Is Continue'),
            'is_selected' => Yii::t('app', 'Is Selected'),
            'divison_id' => Yii::t('app', 'Divison'),
            'class_id' => Yii::t('app', 'Class'),
            'sub_class_id' => Yii::t('app', 'Sub Class'),
            'image' => Yii::t('app', 'Image'),
            'bloodgroup' => Yii::t('app', 'Bloodgroup'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
