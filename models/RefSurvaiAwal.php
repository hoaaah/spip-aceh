<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_survai_awal".
 *
 * @property int $id
 * @property string $p_id
 * @property int $sub_unsur_id
 * @property string $pertanyaan
 * @property string $ref
 *
 * @property KuisionerAwal[] $kuisionerAwals
 * @property RefSubUnsur $subUnsur
 */
class RefSurvaiAwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_survai_awal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'p_id', 'pertanyaan'], 'required'],
            [['id', 'sub_unsur_id'], 'integer'],
            [['pertanyaan'], 'string'],
            [['p_id', 'ref'], 'string', 'max' => 50],
            [['p_id'], 'unique'],
            [['id'], 'unique'],
            [['sub_unsur_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefSubUnsur::className(), 'targetAttribute' => ['sub_unsur_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'p_id' => 'P ID',
            'sub_unsur_id' => 'Sub Unsur ID',
            'pertanyaan' => 'Pertanyaan',
            'ref' => 'Ref',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKuisionerAwals()
    {
        return $this->hasMany(KuisionerAwal::className(), ['survai_awal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubUnsur()
    {
        return $this->hasOne(RefSubUnsur::className(), ['id' => 'sub_unsur_id']);
    }
}
