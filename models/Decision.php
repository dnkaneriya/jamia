<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "decision_master".
 *
 * @property integer $id
 * @property integer $decision_date
 * @property string $content
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Decision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'decision_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['decision_date'], 'safe'],
            [[ 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['content', 'is_active', 'is_deleted'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'decision_date' => Yii::t('app', 'Decision Date'),
            'content' => Yii::t('app', 'Content'),
            'is_active' => Yii::t('app', 'Is Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
}
