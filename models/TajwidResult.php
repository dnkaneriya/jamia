<?php


namespace app\models;



use Yii;



/**

 * This is the model class for table "tajwid_result".

 *

 * @property integer $id
 * @property integer $class_id
 * @property integer $student_id
 * @property string $result
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */

class TajwidResult extends \yii\db\ActiveRecord
{

    /**

     * @inheritdoc

     */

    public static function tableName()

    {

        return 'tajwid_result';

    }



    /**

     * @inheritdoc

     */

    public function rules()

    {

        return [
            [['class_id', 'student_id'], 'required'],
            [['class_id', 'student_id', 'year', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['result', 'is_active', 'is_deleted'], 'string']
        ];

    }



    /**

     * @inheritdoc

     */

    public function attributeLabels()

    {

        return [

            'id' => 'ID',
            'class_id' => 'Class ID',
            'student_id' => 'Student ID',
            'result' => 'Result',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'i_by' => 'I By',
            'i_date' => 'I Date',
            'u_by' => 'U By',
            'u_date' => 'U Date',
        ];

    }

}

