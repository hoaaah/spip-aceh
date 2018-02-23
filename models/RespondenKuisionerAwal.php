<?php

namespace app\models;

use Yii;

class RespondenKuisionerAwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'responden_kuisioner_awal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['tahun', 'post'], 'string'],
            [['id', 'nama_unit', 'nama', 'jabatan'], 'string', 'max' => 100],
            [['pemda_id'], 'string', 'max' => 10],
            [['nip'], 'string', 'max' => 18],
            [['tahun'], 'string', 'max' => 4],
            [['secret_key'], 'string', 'max' => 255],
            [['kategori_jabatan'], 'string', 'max' => 1],
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
            'tahun' => 'Tahun',
            'pemda_id' => 'Pemda ID',
            'nama_unit' => 'Nama Unit',
            'nama' => 'Nama',
            'nip' => 'Nip',
            'jabatan' => 'Jabatan',
            'secret_key' => 'Secret Key',
            'kategori_jabatan' => 'Kategori Jabatan',
            'post' => 'Post',
        ];
    }

    public function getKuisionerAwals()
    {
        return $this->hasMany(KuisionerAwal::className(), ['responden_id' => 'id']);
    }

    public function getUnit()
    {
        $units = Yii::$app->params['unit'];
        return \yii\helpers\ArrayHelper::getValue($units, $this->nama_unit);
    }
}
