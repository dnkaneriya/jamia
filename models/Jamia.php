<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jamia_album".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property integer $album_date
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Jamia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jamia_album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'album_date','is_deleted', 'i_by', 'i_date', 'u_by', 'u_date'], 'safe'],
            [['name'], 'string', 'max' => 255]
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
            'category_id' => Yii::t('app', 'Category ID'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),			
            'album_date' => Yii::t('app', 'Album Date'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
