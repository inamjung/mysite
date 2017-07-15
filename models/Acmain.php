<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acmain".
 *
 * @property integer $id
 * @property integer $actype_id
 * @property string $ac_date
 * @property integer $user_id
 * @property string $create_at
 * @property string $update_at
 */
class Acmain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acmain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actype_id', 'user_id'], 'integer'],
            [['ac_date', 'create_at', 'update_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'actype_id' => 'รายการ/ประเภท',
            'ac_date' => 'รอบบัญชี',
            'user_id' => 'ผู้บันทึก',
            'create_at' => 'วันที่บันทึก',
            'update_at' => 'Update At',
        ];
    }
    public function getDetail(){
        return @$this->hasMany(Acdetail::className(), ['acmain_id'=>'id']);
    }
    public function getType(){
        return @$this->hasOne(Types::className(), ['id'=>'actype_id']);
    }
    
}
