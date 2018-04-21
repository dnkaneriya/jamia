<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StudentProgress;

/**
 * StudentProgressSearch represents the model behind the search form about `app\models\StudentProgress`.
 */
class StudentProgressSearch extends StudentProgress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'grno', 'year', 'month', 'class_id', 'subclass_id', 'category', 'subject_id', 'i_by', 'u_by'], 'integer'],
            [['rating'], 'number'],
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
        $query = StudentProgress::find();

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
            'student_id' => $this->student_id,
            'grno' => $this->grno,
            'year' => $this->year,
            'month' => $this->month,
            'class_id' => $this->class_id,
            'subclass_id' => $this->subclass_id,
            'category' => $this->category,
            'subject_id' => $this->subject_id,
            'rating' => $this->rating,
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
