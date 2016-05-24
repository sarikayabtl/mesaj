<?php

namespace sarikayabtl\mesaj\models;

use Yii;

/**
 * This is the model class for table "konusma".
 *
 * @property integer $id
 * @property integer $konusmaci_1
 * @property integer $konusmaci_2
 *
 * @property User $konusmaci1
 * @property User $konusmaci2
 * @property Mesaj[] $mesajs
 */
class Konusma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'konusma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['konusmaci_1', 'konusmaci_2'], 'required'],
            [['konusmaci_1', 'konusmaci_2'], 'integer'],
            [['konusmaci_1'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['konusmaci_1' => 'id']],
            [['konusmaci_2'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['konusmaci_2' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'konusmaci_1' => 'Konusmaci 1',
            'konusmaci_2' => 'Konusmaci 2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKonusmaci1()
    {
        return $this->hasOne(User::className(), ['id' => 'konusmaci_1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKonusmaci2()
    {
        return $this->hasOne(User::className(), ['id' => 'konusmaci_2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMesajs()
    {
        return $this->hasMany(Mesaj::className(), ['konusma_id' => 'id']);
    }
}
