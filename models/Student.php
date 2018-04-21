<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_master".
 *
 * @property integer $id
 * @property integer $grno
 * @property string $surname_en
 * @property string $surname_ar
 * @property string $firstname_en
 * @property string $firstname_ar
 * @property string $lastname_en
 * @property string $lastname_ar
 * @property string $street
 * @property string $taluka
 * @property string $city
 * @property string $district
 * @property string $pincode
 * @property string $state
 * @property integer $dob
 * @property string $mobile_no
 * @property string $contact_std
 * @property string $landline_no
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
 * @property string $register_status
 * @property string $how_old
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
    public $fullname;
    
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
            [['grno', 'amount', 'divison_id', 'class_id', 'sub_class_id', 'closed_student', 'hafiz_student', 'aalim_student', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'], //'dob', 'date',
            [['fees', 'register_status', 'how_old', 'is_continue', 'is_selected', 'is_active', 'is_deleted'], 'string'],
            //[['parent_mobile'], 'required'],
            [['surname_en', 'surname_ar', 'firstname_en', 'firstname_ar', 'lastname_en', 'lastname_ar', 'street', 'taluka', 'city', 'district', 'pincode', 'state', 'mobile_no', 'contact_std', 'landline_no', 'email', 'mother_name', 'father_name', 'grandfather_name', 'parent_mobile', 'parent_occupation', 'parent_income', 'image', 'bloodgroup'], 'string', 'max' => 255]
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
            'surname_en' => Yii::t('app', 'First Name En'),
            'surname_ar' => Yii::t('app', 'First Name Ar'),
            'firstname_en' => Yii::t('app', 'Middle Name En'),
            'firstname_ar' => Yii::t('app', 'Middle Name Ar'),
            'lastname_en' => Yii::t('app', 'Last Name En'),
            'lastname_ar' => Yii::t('app', 'Last Name Ar'),
            'street' => Yii::t('app', 'Street'),
            'taluka' => Yii::t('app', 'Taluka'),
            'city' => Yii::t('app', 'City'),
            'district' => Yii::t('app', 'District'),
            'pincode' => Yii::t('app', 'Pincode'),
            'state' => Yii::t('app', 'State'),
            'dob' => Yii::t('app', 'Dob'),
            'mobile_no' => Yii::t('app', 'Mobile Number 1'),
            'contact_std' => Yii::t('app', 'Contact Std'),
            'landline_no' => Yii::t('app', 'Landline No'),
            'fees' => Yii::t('app', 'Fees'),
            'amount' => Yii::t('app', 'Amount'),
            'date' => Yii::t('app', 'Date'),
            'email' => Yii::t('app', 'Email'),
            'mother_name' => Yii::t('app', 'Mother Name'),
            'father_name' => Yii::t('app', 'Father Name'),
            'grandfather_name' => Yii::t('app', 'Grandfather Name'),
            'parent_mobile' => Yii::t('app', 'Mobile Number 2'),
            'parent_occupation' => Yii::t('app', 'Parent Occupation'),
            'parent_income' => Yii::t('app', 'Parent Income'),
            'register_status' => Yii::t('app', 'Register Status'),
            'how_old' => Yii::t('app', 'How Old'),
            'is_continue' => Yii::t('app', 'Is Continue'),
            'is_selected' => Yii::t('app', 'Is Selected'),
            'divison_id' => Yii::t('app', 'Divison ID'),
            'class_id' => Yii::t('app', 'Class ID'),
            'sub_class_id' => Yii::t('app', 'Sub Class ID'),
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
    
    public function actionGetFullname()
    {
        return $this->surname_en . " " . $this->firstname_en . " " . $this->lastname_en;
    }
}
