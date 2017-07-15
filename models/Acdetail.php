<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acdetail".
 *
 * @property integer $id
 * @property integer $acmain_id
 * @property integer $customer_id
 * @property string $inventory
 * @property string $amount
 * @property string $pay
 * @property string $remark
 */
class Acdetail extends \yii\db\ActiveRecord
{
    
    const UPDATE_TYPE_CREATE = 'create';
    const UPDATE_TYPE_UPDATE = 'update';
    const UPDATE_TYPE_DELETE = 'delete';
    const SCENARIO_BATCH_UPDATE = 'batchUpdate';

    private $_updateType;

    public function getUpdateType()
    {
        if (empty($this->_updateType)) {
            if ($this->isNewRecord) {
                $this->_updateType = self::UPDATE_TYPE_CREATE;
            } else {
                $this->_updateType = self::UPDATE_TYPE_UPDATE;
            }
        }

        return $this->_updateType;
    }

    public function setUpdateType($value)
    {
        $this->_updateType = $value;
    }   
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acdetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['updateType', 'required', 'on' => self::SCENARIO_BATCH_UPDATE],
            ['updateType',
                'in',
                'range' => [self::UPDATE_TYPE_CREATE, self::UPDATE_TYPE_UPDATE, self::UPDATE_TYPE_DELETE],
                'on' => self::SCENARIO_BATCH_UPDATE]
            ,
            [['inventory','actype_id'],'required'],
            [['actype_id', 'acmain_id', 'customer_id',], 'integer'],
            [['inventory',  'remark'], 'string', 'max' => 255],
            [['amount', 'pay','arrear','total_arrear','amount_arrear'],'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'acmain_id' => 'Acmain ID',
            'customer_id' => 'ลูกค้า',
            'inventory' => 'ได้/เสีย',
            'amount' => 'ยอดเงิน',
            'pay' => 'ยอดชำระ',
            'remark' => 'ค้างชำระ',
            'actype_id'=>'รายการ/ประเภท',
            'arrear'=>'ค้าง'
        ];
    }
    
    public function getMain(){
        return @$this->hasOne(Acmain::className(), ['id'=>'acmain_id']);
    }
    public function getCustomer(){
        return @$this->hasOne(Customers::className(), ['id'=>'customer_id']);
    }
    public function getTypedetail(){
        return @$this->hasOne(Types::className(), ['id'=>'actype_id']);
    }
}
