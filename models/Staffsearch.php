<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Staff;

/**
 * Staffsearch represents the model behind the search form about `app\models\Staff`.
 */
class Staffsearch extends Staff
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'mobile_no', 'sr_no', 'nr_no', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['name', 'city', 'is_active', 'is_deleted','join_date'], 'safe'],
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
        $query = Staff::find();
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
        
              
        $sd = 0;
        $ed = time();
         if(isset($params['Staffsearch']['join_date']) && $params['Staffsearch']['join_date'] != null){
            $sd = strtotime($params['Staffsearch']['join_date']);
            $query->andWhere('join_date = "'.$sd.'"');
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'mobile_no' => $this->mobile_no,
            'join_date' => $this->join_date,
            'sr_no' => $this->sr_no,
            'nr_no' => $this->nr_no,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
