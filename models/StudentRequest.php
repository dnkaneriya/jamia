<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_request".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $request
 * @property integer $date
 * @property string $status
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class StudentRequest extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'student_request';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['student_id', 'request', 'date'], 'required'],
            [['student_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['status', 'is_deleted'], 'string'],
            [['request'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'student_id' => Yii::t('app', 'Student'),
            'request' => Yii::t('app', 'Request'),
            'date' => Yii::t('app', 'Date'),
            'status' => Yii::t('app', 'Status'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }

}
