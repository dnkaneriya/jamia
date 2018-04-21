<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jamia_category".
 *
 * @property integer $id
 * @property string $category
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Jamiacategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jamia_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['category','is_deleted','is_active'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category' => Yii::t('app', 'Category'),
			'is_active' => Yii::t('app', 'Is Active'),
			'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
