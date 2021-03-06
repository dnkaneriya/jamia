<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mark;

/**
 * Marksearch represents the model behind the search form about `app\models\Mark`.
 */
class Marksearch extends Mark
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grno', 'student_id', 'class_id', 'subclass_id', 'division_id', 'subject_id', 'marks', 'markdate', 'exam_id', 'i_by', 'i_date', 'u_by', 'u_date','is_active', 'is_deleted'], 'safe'],
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
        $query = Mark::find();

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
            'grno' => $this->grno,
            'student_id' => $this->student_id,
            'class_id' => $this->class_id,
            'subclass_id' => $this->subclass_id,
            'division_id' => $this->division_id,
            'subject_id' => $this->subject_id,
            'marks' => $this->marks,
            'markdate' => $this->markdate,
            'exam_id' => $this->exam_id,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
	public function groupsearch($params)
    {
        $query = Mark::find();
//		$query->groupBy('grno');
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
            'grno' => $this->grno,
            'student_id' => $this->student_id,
            'class_id' => $this->class_id,
            'subclass_id' => $this->subclass_id,
            'division_id' => $this->division_id,
            'subject_id' => $this->subject_id,
            'marks' => $this->marks,
            'markdate' => $this->markdate,
            'exam_id' => $this->exam_id,
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
