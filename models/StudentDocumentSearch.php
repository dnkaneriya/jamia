<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StudentDocument;

/**
 * StudentDocumentSearch represents the model behind the search form about `app\models\StudentDocument`.
 */
class StudentDocumentSearch extends StudentDocument
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id',  'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['doc_type', 'doc_path', 'note', 'is_active', 'id_deleted'], 'safe'],
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
        $query = StudentDocument::find();

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
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'doc_type', $this->doc_type])
            ->andFilterWhere(['like', 'doc_path', $this->doc_path])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'id_deleted', $this->id_deleted]);

        return $dataProvider;
    }
}
