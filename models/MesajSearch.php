<?php

namespace sarikayabtl\mesaj\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use sarikayabtl\mesaj\models\Mesaj;

/**
 * MesajSearch represents the model behind the search form about `backend\modules\mesaj\models\Mesaj`.
 */
class MesajSearch extends Mesaj
{
    /**
     * @inheritdoc
     */
	public $_alici;
	public $_gonderen;
    public function rules()
    {
        return [
            [['id', 'gonderen_id', 'alici_id'], 'integer'],
            [['icerik', 'tarih','_alici','_gonderen'], 'safe'],
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
        $query = Mesaj::find();

        // add conditions that should always apply here
        $query->joinWith(['alici']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $dataProvider->sort->attributes['_alici'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['user.username' => SORT_ASC],
        'desc' => ['user.username' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['_gonderen'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['user.username' => SORT_ASC],
        'desc' => ['user.username' => SORT_DESC],
        ];
        

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'gonderen_id' => $this->gonderen_id,
            'alici_id' => $this->alici_id,
            'tarih' => $this->tarih,
        ]);

        $query->andFilterWhere(['like', 'icerik', $this->icerik]);
        $query->andFilterWhere(['like', 'user.username', $this->_alici]);
        $query->andFilterWhere(['like', 'user.username', $this->_gonderen]);

        return $dataProvider;
    }
}
