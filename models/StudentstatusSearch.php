<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Studentstatus;

/**
 * StudentstatusSearch represents the model behind the search form about `app\models\Studentstatus`.
 */
class StudentstatusSearch extends Studentstatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'join_date', 'left_date', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['is_continue', 'reason', 'is_active', 'is_deleted'], 'safe'],
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
        $query = Studentstatus::find();
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
            'student_id' => $this->student_id,
            'join_date' => $this->join_date,
            'left_date' => $this->left_date,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'is_continue', $this->is_continue])
            ->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
