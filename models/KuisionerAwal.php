<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kuisioner_awal".
 *
 * @property string $id
 * @property string $tahun
 * @property string $responden_id
 * @property string $pemda_id
 * @property int $survai_awal_id
 * @property string $p_id
 * @property int $jawaban
 *
 * @property RefSurvaiAwal $survaiAwal
 * @property RespondenKuisionerAwal $responden
 */
class KuisionerAwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kuisioner_awal';
    }

    public $jawabanArray;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['tahun', 'jawabanArray'], 'safe'],
            [['survai_awal_id'], 'integer'],
            [['id', 'responden_id'], 'string', 'max' => 100],
            [['pemda_id'], 'string', 'max' => 10],
            [['p_id'], 'string', 'max' => 50],
            [['jawaban'], 'integer', 'max' => 1],
            [['id'], 'unique'],
            // [['survai_awal_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefSurvaiAwal::className(), 'targetAttribute' => ['survai_awal_id' => 'id']],
            // [['responden_id'], 'exist', 'skipOnError' => true, 'targetClass' => RespondenKuisionerAwal::className(), 'targetAttribute' => ['responden_id' => 'id']],
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
    public function getSurvaiAwal()
    {
        return $this->hasOne(RefSurvaiAwal::className(), ['id' => 'survai_awal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponden()
    {
        return $this->hasOne(RespondenKuisionerAwal::className(), ['id' => 'responden_id']);
    }
}
