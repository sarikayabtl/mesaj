<?php

namespace sarikayabtl\mesaj\models;

use Yii;

/**
 * This is the model class for table "mesaj".
 *
 * @property integer $id
 * @property string $icerik
 * @property integer $konusma_id
 * @property integer $gonderen_id
 * @property string $tarih
 *
 * @property Konusma $konusma
 * @property User $gonderen
 */
class Mesaj extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mesaj';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icerik', 'konusma_id', 'gonderen_id', 'tarih'], 'required'],
            [['icerik'], 'string'],
            [['konusma_id', 'gonderen_id'], 'integer'],
            [['tarih'], 'safe'],
            [['konusma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Konusma::className(), 'targetAttribute' => ['konusma_id' => 'id']],
            [['gonderen_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['gonderen_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'icerik' => 'Icerik',
            'konusma_id' => 'Konusma ID',
            'gonderen_id' => 'Gonderen ID',
            'tarih' => 'Tarih',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKonusma()
    {
        return $this->hasOne(Konusma::className(), ['id' => 'konusma_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGonderen()
    {
        return $this->hasOne(User::className(), ['id' => 'gonderen_id']);
    }
}
