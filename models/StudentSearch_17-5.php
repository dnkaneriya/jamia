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
    
    public $full_name;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grno', 'dob', 'amount', 'date', 'divison_id', 'class_id', 'sub_class_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['surname_en', 'surname_ar', 'firstname_en', 'firstname_ar', 'lastname_en', 'lastname_ar', 'street', 'taluka', 'city', 'district', 'pincode', 'state', 'mobile_no', 'contact_std', 'landline_no', 'fees', 'email', 'mother_name', 'father_name', 'grandfather_name', 'parent_mobile', 'parent_occupation', 'parent_income', 'register_status', 'how_old', 'is_continue', 'is_selected', 'image', 'bloodgroup', 'is_active', 'is_deleted'], 'safe'],
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
        
        /*$timestamp = date_create_from_format("d-M-Y", $model->i_date);
        $model->i_date = date("U", $timestamp);*/
        
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
        
        $query->andFilterWhere(['like', 'surname_en', $this->surname_en])
            ->andFilterWhere(['like', 'surname_ar', $this->surname_ar])
            ->andFilterWhere(['like', 'firstname_en', $this->firstname_en])
            ->andFilterWhere(['like', 'firstname_ar', $this->firstname_ar])
            ->andFilterWhere(['like', 'lastname_en', $this->lastname_en])
            ->andFilterWhere(['like', 'lastname_ar', $this->lastname_ar])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'taluka', $this->taluka])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'pincode', $this->pincode])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'contact_std', $this->contact_std])
            ->andFilterWhere(['like', 'landline_no', $this->landline_no])
            ->andFilterWhere(['like', 'fees', $this->fees])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'grandfather_name', $this->grandfather_name])
            ->andFilterWhere(['like', 'parent_mobile', $this->parent_mobile])
            ->andFilterWhere(['like', 'parent_occupation', $this->parent_occupation])
            ->andFilterWhere(['like', 'parent_income', $this->parent_income])
            ->andFilterWhere(['like', 'register_status', $this->register_status])
            ->andFilterWhere(['like', 'how_old', $this->how_old])
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
        
        /*if(isset($_REQUEST['grno']) && $_REQUEST['grno'] != 'Gr No.'){
            $query->andWhere(['grno'=>$params['grno']]);
        }*/

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

        $query->andFilterWhere(['like', 'surname_en', $this->surname_en])
            ->andFilterWhere(['like', 'surname_ar', $this->surname_ar])
            ->andFilterWhere(['like', 'firstname_en', $this->firstname_en])
            ->andFilterWhere(['like', 'firstname_ar', $this->firstname_ar])
            ->andFilterWhere(['like', 'lastname_en', $this->lastname_en])
            ->andFilterWhere(['like', 'lastname_ar', $this->lastname_ar])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'taluka', $this->taluka])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'pincode', $this->pincode])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'contact_std', $this->contact_std])
            ->andFilterWhere(['like', 'landline_no', $this->landline_no])
            ->andFilterWhere(['like', 'fees', $this->fees])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'grandfather_name', $this->grandfather_name])
            ->andFilterWhere(['like', 'parent_mobile', $this->parent_mobile])
            ->andFilterWhere(['like', 'parent_occupation', $this->parent_occupation])
            ->andFilterWhere(['like', 'parent_income', $this->parent_income])
            ->andFilterWhere(['like', 'register_status', $this->register_status])
            ->andFilterWhere(['like', 'how_old', $this->how_old])
            ->andFilterWhere(['like', 'is_continue', $this->is_continue])
            ->andFilterWhere(['like', 'is_selected', $this->is_selected])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'bloodgroup', $this->bloodgroup])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
    
    public function confirmedstudent($params)
    {
        $query = Student::find();
        $query->where(['is_selected'=>'C', 'is_deleted'=>'N']);
        
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

        $query->andFilterWhere(['like', 'surname_en', $this->surname_en])
            ->andFilterWhere(['like', 'surname_ar', $this->surname_ar])
            ->andFilterWhere(['like', 'firstname_en', $this->firstname_en])
            ->andFilterWhere(['like', 'firstname_ar', $this->firstname_ar])
            ->andFilterWhere(['like', 'lastname_en', $this->lastname_en])
            ->andFilterWhere(['like', 'lastname_ar', $this->lastname_ar])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'taluka', $this->taluka])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'pincode', $this->pincode])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'contact_std', $this->contact_std])
            ->andFilterWhere(['like', 'landline_no', $this->landline_no])
            ->andFilterWhere(['like', 'fees', $this->fees])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'grandfather_name', $this->grandfather_name])
            ->andFilterWhere(['like', 'parent_mobile', $this->parent_mobile])
            ->andFilterWhere(['like', 'parent_occupation', $this->parent_occupation])
            ->andFilterWhere(['like', 'parent_income', $this->parent_income])
            ->andFilterWhere(['like', 'register_status', $this->register_status])
            ->andFilterWhere(['like', 'how_old', $this->how_old])
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
        $size=\Yii::$app->session->get('user.size');
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
        
        $sd = 0;
        $ed = time();
        if(isset($params['StudentSearch']['i_date']) && $params['StudentSearch']['i_date'] != null){
            $sd = strtotime($params['StudentSearch']['i_date']);
            $ed = $sd + 86400;
            
            //$query->andWhere('i_datee >= :sd and i_date < :ed',[':sd'=>$sd,':ed'=>$ed]);
            $query->andWhere('i_date >= :sd and i_date < :ed',[':sd'=>$sd,':ed'=>$ed]);
        }
        if(isset($params['StudentSearch']['state']) && $params['StudentSearch']['state'] != null){
            $query->andWhere(['state'=>$params['StudentSearch']['state']]);
        }
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

        $query->andFilterWhere(['or',
        ['like','surname_en',$this->full_name],
        ['like','firstname_en',$this->full_name],
		['like','lastname_en',$this->full_name]])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'taluka', $this->taluka])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'pincode', $this->pincode])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'contact_std', $this->contact_std])
            ->andFilterWhere(['like', 'landline_no', $this->landline_no])
            ->andFilterWhere(['like', 'fees', $this->fees])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'grandfather_name', $this->grandfather_name])
            ->andFilterWhere(['like', 'parent_mobile', $this->parent_mobile])
            ->andFilterWhere(['like', 'parent_occupation', $this->parent_occupation])
            ->andFilterWhere(['like', 'parent_income', $this->parent_income])
            ->andFilterWhere(['like', 'register_status', $this->register_status])
            ->andFilterWhere(['like', 'how_old', $this->how_old])
            ->andFilterWhere(['like', 'is_continue', $this->is_continue])
            ->andFilterWhere(['like', 'is_selected', $this->is_selected])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'bloodgroup', $this->bloodgroup])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
