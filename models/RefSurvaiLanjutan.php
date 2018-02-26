<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_survai_lanjutan".
 *
 * @property int $id
 * @property string $p_id
 * @property int $sub_unsur_id
 * @property string $pertanyaan
 * @property string $ref
 *
 * @property KuisionerLanjutan[] $kuisionerLanjutans
 */
class RefSurvaiLanjutan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_survai_lanjutan';
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
    public function getKuisionerLanjutans()
    {
        return $this->hasMany(KuisionerLanjutan::className(), ['survai_lanjutan_id' => 'id']);
    }
}
