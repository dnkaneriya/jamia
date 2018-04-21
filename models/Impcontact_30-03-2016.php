<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imp_contact_number".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $district
 * @property string $state
 * @property integer $mobile
 * @property integer $landline
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Impcontact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imp_contact_number';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'city', 'district', 'state', 'mobile'], 'required'],
            [['mobile', 'landline', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['is_active', 'is_deleted'], 'string'],
            [['name', 'address', 'city', 'district', 'state'], 'string', 'max' => 255]
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
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'district' => Yii::t('app', 'District'),
            'state' => Yii::t('app', 'State'),
            'mobile' => Yii::t('app', 'Mobile'),
            'landline' => Yii::t('app', 'Landline'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
