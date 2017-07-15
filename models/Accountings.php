<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accountings".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type_id
 * @property integer $customer_id
 * @property double $amount
 * @property double $pay
 * @property string $ac_id
 * @property string $ac_date
 */
class Accountings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accountings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'customer_id'], 'integer'],
            [['amount', 'pay'], 'number'],
            [['ac_id'], 'string'],
            [['ac_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'รายการ',
            'type_id' => 'ประเภท',
            'customer_id' => 'ลูกค้า',
            'amount' => 'ยอดเงิน',
            'pay' => 'ยอดชำระ',
            'ac_id' => 'ชนิด',
            'ac_date' => 'รอบทำบัญชี',
        ];
    }
}
