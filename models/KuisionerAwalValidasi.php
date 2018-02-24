<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kuisioner_awal_validasi".
 *
 * @property string $id
 * @property string $tahun
 * @property string $responden_id
 * @property string $pemda_id
 * @property int $survai_awal_id
 * @property string $p_id
 * @property int $jawaban
 *
 * @property KuisionerAwal $id0
 */
class KuisionerAwalValidasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kuisioner_awal_validasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['tahun'], 'safe'],
            [['survai_awal_id'], 'integer'],
            [['id', 'responden_id'], 'string', 'max' => 100],
            [['pemda_id'], 'string', 'max' => 10],
            [['p_id'], 'string', 'max' => 50],
            [['jawaban'], 'string', 'max' => 1],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => KuisionerAwal::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'responden_id' => 'Responden ID',
            'pemda_id' => 'Pemda ID',
            'survai_awal_id' => 'Survai Awal ID',
            'p_id' => 'P ID',
            'jawaban' => 'Jawaban',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(KuisionerAwal::className(), ['id' => 'id']);
    }
}
