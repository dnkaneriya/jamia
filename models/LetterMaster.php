<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "letter_master".
 *
 * @property integer $id
 * @property integer $type
 * @property string $to
 * @property string $from
 * @property string $subject
 * @property string $content
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class LetterMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'letter_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'subject'], 'required'],
            [['type', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['content', 'is_active', 'is_deleted'], 'string'],
            [['to', 'from', 'subject'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'to' => Yii::t('app', 'To'),
            'from' => Yii::t('app', 'From'),
            'subject' => Yii::t('app', 'Subject'),
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
