<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Studenteducation;

/**
 * StudenteducationSearch represents the model behind the search form about `app\models\Studenteducation`.
 */
class StudenteducationSearch extends Studenteducation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'nazra_para', 'hifz_para', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['madrasa_name', 'nazra', 'hifz', 'arabic', 'urdu', 'school_name', 'school_medium', 'grade','school_standard'], 'safe'],
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
        $query = Studenteducation::find();

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
            'nazra_para' => $this->nazra_para,
            'hifz_para' => $this->hifz_para,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'madrasa_name', $this->madrasa_name])
            ->andFilterWhere(['like', 'nazra', $this->nazra])
            ->andFilterWhere(['like', 'hifz', $this->hifz])
            ->andFilterWhere(['like', 'arabic', $this->arabic])
            ->andFilterWhere(['like', 'urdu', $this->urdu])
            ->andFilterWhere(['like', 'school_name', $this->school_name])
            ->andFilterWhere(['like', 'school_standard', $this->school_standard])			
            ->andFilterWhere(['like', 'school_medium', $this->school_medium])
            ->andFilterWhere(['like', 'grade', $this->grade]);

        return $dataProvider;
    }
}
