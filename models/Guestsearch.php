<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Guest;

/**
 * Guestsearch represents the model behind the search form about `app\models\Guest`.
 */
class Guestsearch extends Guest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['full_name', 'is_active', 'is_deleted','in_date', 'out_date'], 'safe'],
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
        $query = Guest::find();
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
         if(isset($params['Guestsearch']['in_date']) && $params['Guestsearch']['in_date'] != null){
            $sd = strtotime($params['Guestsearch']['in_date']);
            $query->andWhere('in_date >= "'.$sd.'"');
        }

		$sd = 0;
        $ed = time();
         if(isset($params['Guestsearch']['out_date']) && $params['Guestsearch']['out_date'] != null){
            $sd = strtotime($params['Guestsearch']['out_date']);
            $query->andWhere('out_date <= "'.$sd.'"');
        }
		
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
