<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bed;

/**
 * Bedsearch represents the model behind the search form about `app\models\Bed`.
 */
class Bedsearch extends Bed
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'room_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['bed_no', 'is_active', 'is_deleted'], 'safe'],
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
        $query = Bed::find();
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
            'room_id' => $this->room_id,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'bed_no', $this->bed_no])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
