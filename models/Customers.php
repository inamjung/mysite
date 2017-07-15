<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $id
 * @property string $name
 * @property string $tel
 * @property string $addr
 * @property string $blank
 * @property string $book_no
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tel', 'addr'], 'string', 'max' => 255],
            [['blank', 'book_no'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ-สกุล',
            'tel' => 'เบอร์โทร',
            'addr' => 'ที่อยู่',
            'blank' => 'ธนาคาร',
            'book_no' => 'เลขี่บัญชี',
        ];
    }
    public function getCusacdetail(){
        return $this->hasMany(Acdetail::className(), ['customer_id'=>'id']);
    }
}
