<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tajwid_exam".
 *
 * @property integer $id
 * @property string $name
 * @property integer $total_marks
 * @property integer $passing_marks
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class TajwidExam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tajwid_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'total_marks', 'passing_marks'], 'required'],
            [['total_marks', 'passing_marks', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['is_active', 'is_deleted'], 'string'],
            [['name'], 'string', 'max' => 255]
            
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'total_marks' => 'Total Marks',
            'passing_marks' => 'Passing Marks',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'i_by' => 'I By',
            'i_date' => 'I Date',
            'u_by' => 'U By',
            'u_date' => 'U Date',
        ];
    }
}
