<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClassUpgradeMaster;

/**
 * ClassUpgradeMasterSearch represents the model behind the search form about `app\models\ClassUpgradeMaster`.
 */
class ClassUpgradeMasterSearch extends ClassUpgradeMaster
{

    public $className;
    public $classupgradeName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'class_id', 'subclass_id', 'upgrade_id', 'upgrade_subclass_id', 'is_active', 'is_deleted', 'i_by', 'i_at', 'u_by', 'u_at'], 'integer'],
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
        $query = ClassUpgradeMaster::find();

        $query->joinWith('class');

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
            'upgrade_id' => $this->upgrade_id,
            'upgrade_subclass_id' => $this->upgrade_subclass_id,
            'is_active' => $this->is_active,
            'is_deleted' => $this->is_deleted,
            'i_by' => $this->i_by,
            'i_at' => $this->i_at,
            'u_by' => $this->u_by,
            'u_at' => $this->u_at,
        ]);

        $query->andFilterWhere(['like', 'class.name', $this->className]);

        return $dataProvider;
    }
}
