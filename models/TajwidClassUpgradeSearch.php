<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TajwidClassUpgrade;

/**
 * TajwidClassUpgradeSearch represents the model behind the search form about `app\models\TajwidClassUpgrade`.
 */
class TajwidClassUpgradeSearch extends TajwidClassUpgrade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'class_id', 'upgrade_class_id', 'i_by', 'u_by'], 'integer'],
            [['is_active', 'is_deleted', 'i_date', 'u_date'], 'safe'],
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
        $query = TajwidClassUpgrade::find();

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
            'upgrade_class_id' => $this->upgrade_class_id,
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
