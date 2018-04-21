<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Student;

/**
 * StudentSearch represents the model behind the search form about `app\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grno', 'dob', 'amount', 'date', 'divison_id', 'class_id', 'sub_class_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['name_en', 'name_ar', 'address', 'city', 'state', 'contact_no', 'fees', 'email', 'mother_name', 'father_name', 'grandfather_name', 'parent_mobile', 'parent_occupation', 'parent_income', 'is_continue', 'is_selected', 'image', 'bloodgroup', 'is_active', 'is_deleted'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $size=\Yii::$app->session->get('user.size');
        $query = Student::find();
        $query->where(['is_deleted'=>'N']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => isset($size) ? $size : 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC, 
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'grno' => $this->grno,
            'dob' => $this->dob,
            'amount' => $this->amount,
            'date' => $this->date,
            'divison_id' => $this->divison_id,
            'class_id' => $this->class_id,
            'sub_class_id' => $this->sub_class_id,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'name_ar', $this->name_ar])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'fees', $this->fees])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'grandfather_name', $this->grandfather_name])
            ->andFilterWhere(['like', 'parent_mobile', $this->parent_mobile])
            ->andFilterWhere(['like', 'parent_occupation', $this->parent_occupation])
            ->andFilterWhere(['like', 'parent_income', $this->parent_income])
            ->andFilterWhere(['like', 'is_continue', $this->is_continue])
            ->andFilterWhere(['like', 'is_selected', $this->is_selected])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'bloodgroup', $this->bloodgroup])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
    
    public function selectedstudent($params)
    {
        //echo "<pre>";print_r($params);die;
        //$size=\Yii::$app->session->get('user.size');
        $query = Student::find();
        $query->where(['is_selected'=>'Y', 'is_deleted'=>'N']);
        
        if(isset($_REQUEST['grno']) && $_REQUEST['grno'] != 'Gr No.'){
            $query->andWhere(['grno'=>$params['grno']]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => isset($size) ? $size : 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC, 
                ]
            ],
            
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'grno' => $this->grno,
            'amount' => $this->amount,
            'date' => $this->date,
            'divison_id' => $this->divison_id,
            'class_id' => $this->class_id,
            'sub_class_id' => $this->sub_class_id,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'name_ar', $this->name_ar])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'fees', $this->fees])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'grandfather_name', $this->grandfather_name])
            ->andFilterWhere(['like', 'parent_mobile', $this->parent_mobile])
            ->andFilterWhere(['like', 'parent_occupation', $this->parent_occupation])
            ->andFilterWhere(['like', 'parent_income', $this->parent_income])
            ->andFilterWhere(['like', 'is_continue', $this->is_continue])
            ->andFilterWhere(['like', 'is_selected', $this->is_selected])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'bloodgroup', $this->bloodgroup])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
    
    public function pendingstudent($params)
    {
        //echo "<pre>";print_r($params);die;
        //$size=\Yii::$app->session->get('user.size');
        $query = Student::find();
        $query->where(['is_selected'=>'P', 'is_deleted'=>'N']);
        
        if(isset($_REQUEST['grno']) && $_REQUEST['grno'] != 'Gr No.'){
            $query->andWhere(['grno'=>$params['grno']]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => isset($size) ? $size : 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC, 
                ]
            ],
            
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'grno' => $this->grno,
            'amount' => $this->amount,
            'date' => $this->date,
            'divison_id' => $this->divison_id,
            'class_id' => $this->class_id,
            'sub_class_id' => $this->sub_class_id,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'name_ar', $this->name_ar])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'fees', $this->fees])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'grandfather_name', $this->grandfather_name])
            ->andFilterWhere(['like', 'parent_mobile', $this->parent_mobile])
            ->andFilterWhere(['like', 'parent_occupation', $this->parent_occupation])
            ->andFilterWhere(['like', 'parent_income', $this->parent_income])
            ->andFilterWhere(['like', 'is_continue', $this->is_continue])
            ->andFilterWhere(['like', 'is_selected', $this->is_selected])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'bloodgroup', $this->bloodgroup])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
