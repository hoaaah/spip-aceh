<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kuisioner_lanjutan".
 *
 * @property string $id
 * @property string $tahun
 * @property string $responden_id
 * @property string $pemda_id
 * @property int $survai_lanjutan_id
 * @property string $p_id
 * @property int $jawaban
 *
 * @property RefSurvaiLanjutan $survaiLanjutan
 * @property RespondenKuisionerLanjutan $responden
 */
class KuisionerLanjutan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kuisioner_lanjutan';
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
            [['survai_lanjutan_id'], 'integer'],
            [['id', 'responden_id'], 'string', 'max' => 100],
            [['pemda_id'], 'string', 'max' => 10],
            [['p_id'], 'string', 'max' => 50],
            [['jawaban'], 'string', 'max' => 1],
            [['id'], 'unique'],
            [['survai_lanjutan_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefSurvaiLanjutan::className(), 'targetAttribute' => ['survai_lanjutan_id' => 'id']],
            [['responden_id'], 'exist', 'skipOnError' => true, 'targetClass' => RespondenKuisionerLanjutan::className(), 'targetAttribute' => ['responden_id' => 'id']],
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
            'survai_lanjutan_id' => 'Survai Lanjutan ID',
            'p_id' => 'P ID',
            'jawaban' => 'Jawaban',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurvaiLanjutan()
    {
        return $this->hasOne(RefSurvaiLanjutan::className(), ['id' => 'survai_lanjutan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponden()
    {
        return $this->hasOne(RespondenKuisionerLanjutan::className(), ['id' => 'responden_id']);
    }
}
