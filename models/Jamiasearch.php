<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jamia;

/**
 * Jamiasearch represents the model behind the search form about `app\models\Jamia`.
 */
class Jamiasearch extends Jamia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'album_date','is_deleted', 'i_by', 'i_date', 'u_by', 'u_date','name'], 'safe'],
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
        $query = Jamia::find();
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

		$sd = 0;
        $ed = time();
         if(isset($params['Jamiasearch']['album_date']) && $params['Jamiasearch']['album_date'] != null){
            $sd = strtotime($params['Jamiasearch']['album_date']);
            $query->andWhere('album_date = "'.$sd.'"');
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'album_date' => $this->album_date,
            'i_by' => $this->i_by,
            'i_date' => $this->i_date,
            'u_by' => $this->u_by,
            'u_date' => $this->u_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
	   		  ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
