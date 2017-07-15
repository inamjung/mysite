<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Acmain;

/**
 * AcmainSearch represents the model behind the search form about `app\models\Acmain`.
 */
class AcmainSearch extends Acmain
{
    /**
     * @inheritdoc
     */
//    public $ac_date1;
//    public $ac_date2;
    public function rules()
    {
        return [
            [['id', 'actype_id', 'user_id'], 'integer'],
            [['ac_date','create_at', 'update_at'], 'safe'],
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
        $query = Acmain::find();

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
        $dataProvider->query->joinWith('type');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'actype_id' => $this->actype_id,
            'ac_date' => $this->ac_date,
            'user_id' => $this->user_id,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);
        $query
                //->andFilterWhere(['>=', 'ac_date', $this->ac_date1])
            //->andFilterWhere(['<=', 'ac_date', $this->ac_date2])
             
            ->andFilterWhere(['like', 'types.name', $this->actype_id])     
            ;

        return $dataProvider;
    }
}
