<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TajwidResult;

/**
 * TajwidResultSearch represents the model behind the search form about `app\models\TajwidResult`.
 */
class TajwidResultSearch extends TajwidResult
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_id', 'student_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['result', 'is_active', 'is_deleted'], 'safe'],
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
        $query = TajwidResult::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'class_id' => $this->class_id,
            'student_id' => $this->student_id,
            'result' => $this->result,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
