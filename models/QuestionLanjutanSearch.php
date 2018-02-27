<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\QuestionsList;

/**
 * QuestionSearch represents the model behind the search form of `app\models\QuestionsList`.
 */
class QuestionLanjutanSearch extends QuestionsListLanjutan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kd_unsur', 'kd_sub_unsur', 'id_sub_unsur', 'id'], 'integer'],
            [['nama_unsur', 'nama_sub_unsur', 'p_id', 'pertanyaan'], 'safe'],
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
        $query = QuestionsListLanjutan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'kd_unsur' => $this->kd_unsur,
            'kd_sub_unsur' => $this->kd_sub_unsur,
            'id_sub_unsur' => $this->id_sub_unsur,
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'nama_unsur', $this->nama_unsur])
            ->andFilterWhere(['like', 'nama_sub_unsur', $this->nama_sub_unsur])
            ->andFilterWhere(['like', 'p_id', $this->p_id])
            ->andFilterWhere(['like', 'pertanyaan', $this->pertanyaan]);

        return $dataProvider;
    }
}
