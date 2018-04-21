<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Program;

/**
 * Programsearch represents the model behind the search form about `app\models\Program`.
 */
class Programsearch extends Program
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['id', 'p_date','name', 'grnos', 'is_deleted'], 'safe'],
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
        $query = Program::find();

        $size=\Yii::$app->session->get('user.size');
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
        if(isset($params['Programsearch']['p_date']) && $params['Programsearch']['p_date'] != null){
            $sd = strtotime($params['Programsearch']['p_date']);
            $ed = $sd + 86400;
            
            //$query->andWhere('i_datee >= :sd and i_date < :ed',[':sd'=>$sd,':ed'=>$ed]);
            $query->andWhere('p_date >= :sd and p_date < :ed',[':sd'=>$sd,':ed'=>$ed]);
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'p_date' => $this->p_date,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'grnos', $this->grnos])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
