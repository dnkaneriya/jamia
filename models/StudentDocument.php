<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_document".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $grno
 * @property string $doc_type
 * @property string $doc_path
 * @property string $note
 * @property string $is_active
 * @property string $id_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class StudentDocument extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $imageFile;

    public static function tableName() {
        return 'student_document';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['student_id', 'doc_type', 'doc_path'], 'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg'], 'checkExtensionByMimeType' => false,],
            [['student_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['doc_type', 'is_active', 'id_deleted'], 'string'],
            [['doc_path', 'note'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'student_id' => Yii::t('app', 'Student'),
            'doc_type' => Yii::t('app', 'Doc Type'),
            'doc_path' => Yii::t('app', 'Doc Path'),
            'note' => Yii::t('app', 'Note'),
            'is_active' => Yii::t('app', 'Is Active'),
            'id_deleted' => Yii::t('app', 'Id Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $this->imageFile->saveAs(Yii::getAlias('@webroot') . "/uploads/student_docs/" . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->doc_path = "/uploads/student_docs/" . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            return true;
        } else {
            return false;
        }
    }

}
