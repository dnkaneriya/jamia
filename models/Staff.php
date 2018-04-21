<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff_master".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $city
 * @property integer $mobile_no
 * @property integer $join_date
 * @property integer $sr_no
 * @property integer $nr_no
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'mobile_no', 'sr_no', 'nr_no', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['is_active', 'is_deleted'], 'string'],
			[['join_date'],'safe'],
            [['name', 'city'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category'),
            'name' => Yii::t('app', 'Name'),
            'city' => Yii::t('app', 'City'),
            'mobile_no' => Yii::t('app', 'Mobile No'),
            'join_date' => Yii::t('app', 'Join Date'),
            'sr_no' => Yii::t('app', 'Sr No'),
            'nr_no' => Yii::t('app', 'Nr No'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
