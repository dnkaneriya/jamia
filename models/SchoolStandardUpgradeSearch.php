<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SchoolStandardUpgrade;

/**
 * SchoolStandardUpgradeSearch represents the model behind the search form about `app\models\SchoolStandardUpgrade`.
 */
class SchoolStandardUpgradeSearch extends SchoolStandardUpgrade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'standard_id', 'upgrade_standard_id', 'i_by', 'u_by'], 'integer'],
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
        $query = SchoolStandardUpgrade::find();

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
            'standard_id' => $this->standard_id,
            'upgrade_standard_id' => $this->upgrade_standard_id,
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
