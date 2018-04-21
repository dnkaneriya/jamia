<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SchoolExam;

/**
 * SchoolExamSearch represents the model behind the search form about `app\models\SchoolExam`.
 */
class SchoolExamSearch extends SchoolExam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'class_id', 'subclass_id', 'total_mark', 'passing_mark', 'no_of_semester', 'i_at', 'i_by', 'u_at', 'u_by'], 'integer'],
            [['standard', 'is_active', 'is_deleted'], 'safe'],
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
        $query = SchoolExam::find();

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
            'subclass_id' => $this->subclass_id,
            'total_mark' => $this->total_mark,
            'passing_mark' => $this->passing_mark,
            'no_of_semester' => $this->no_of_semester,
            'i_at' => $this->i_at,
            'i_by' => $this->i_by,
            'u_at' => $this->u_at,
            'u_by' => $this->u_by,
        ]);

        $query->andFilterWhere(['like', 'standard', $this->standard])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
