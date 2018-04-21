<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Leave;

/**
 * Leavesearch represents the model behind the search form about `app\models\Leave`.
 */
class Leavesearch extends Leave
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'staff_id', 'type_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['reason', 'is_active', 'is_deleted','staff_cat_id', 'leave_date'], 'safe'],
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
        $query = Leave::find();
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
         if(isset($params['Leavesearch']['leave_date']) && $params['Leavesearch']['leave_date'] != null){
            $sd = strtotime($params['Leavesearch']['leave_date']);
            $query->andWhere('leave_date = "'.$sd.'"');
        }

        $query->andFilterWhere([
            'id' => $this->id,
			'staff_cat_id'=>$this->staff_cat_id,
            'staff_id' => $this->staff_id,
            'type_id' => $this->type_id,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
