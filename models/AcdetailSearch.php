<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Acdetail;

/**
 * AcdetailSearch represents the model behind the search form about `app\models\Acdetail`.
 */
class AcdetailSearch extends Acdetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'id', 'acmain_id'], 'integer'],
            [['amount', 'pay','arrear','total_arrear','amount_arrear'],'number'],
            [['customer_id','actype_id','inventory','remark'], 'safe'],
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
        $query = Acdetail::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>[
                    'id'=>'SORT_DESC'
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $dataProvider->query->joinWith('typedetail');
        $dataProvider->query->joinWith('customer');
        
        $query->andFilterWhere([
            'id' => $this->id,
            'acmain_id' => $this->acmain_id,
            'arrear' => $this->arrear,
            'total_arrear' => $this->total_arrear,
            'amount_arrear' => $this->amount_arrear,
            'amount' => $this->amount,
            'pay' => $this->pay,
            
            //'customer_id' => $this->customer_id,
            //'actype_id'=>  $this->actype_id
        ]);

        $query->andFilterWhere(['like', 'inventory', $this->inventory])
//            ->andFilterWhere(['like', 'amount', $this->amount])
//            ->andFilterWhere(['like', 'pay', $this->pay])
            ->andFilterWhere(['like', 'types.name', $this->actype_id])  
            ->andFilterWhere(['like', 'customers.name', $this->customer_id])    
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
