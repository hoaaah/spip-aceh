<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RespondenKuisionerAwal;

/**
 * RespondenSearch represents the model behind the search form of `app\models\RespondenKuisionerAwal`.
 */
class RespondenSearch extends RespondenKuisionerAwal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tahun', 'pemda_id', 'nama_unit', 'nama', 'nip', 'jabatan', 'secret_key'], 'safe'],
            [['kategori_jabatan', 'post'], 'integer'],
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
        $query = RespondenKuisionerAwal::find();

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
            'tahun' => $this->tahun,
            'kategori_jabatan' => $this->kategori_jabatan,
            'post' => $this->post,
            'nama_unit' => $this->nama_unit,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'pemda_id', $this->pemda_id])
            // ->andFilterWhere(['like', 'nama_unit', $this->nama_unit])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'jabatan', $this->jabatan])
            ->andFilterWhere(['like', 'secret_key', $this->secret_key]);

        return $dataProvider;
    }
}
