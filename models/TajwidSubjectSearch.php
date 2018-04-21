<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TajwidSubject;

/**
 * TajwidSubjectSearch represents the model behind the search form about `app\models\TajwidSubject`.
 */
class TajwidSubjectSearch extends TajwidSubject {

    /**
     * @inheritdoc
     */
    public $TajwidName;

    public function rules() {
        return [
            [['id', 'tajwid_class_id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['subject_name', 'is_active', 'is_deleted'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = TajwidSubject::find();

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
            'tajwid_class_id' => $this->tajwid_class_id,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'subject_name', $this->subject_name])
                ->andFilterWhere(['like', 'is_active', $this->is_active])
                ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        $query->andWhere(['is_deleted' => 'N']);
        return $dataProvider;
    }

}
