<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "responden_kuisioner_lanjutan".
 *
 * @property string $id
 * @property string $tahun
 * @property string $pemda_id
 * @property string $nama_unit
 * @property string $nama
 * @property string $nip
 * @property string $jabatan
 * @property string $secret_key
 * @property int $kategori_jabatan 1 => Es.1 2=> Es.2 3=> Es.3 4=> Es.4 5=> Staff
 * @property int $post
 *
 * @property KuisionerLanjutan[] $kuisionerLanjutans
 */
class RespondenKuisionerLanjutan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'responden_kuisioner_lanjutan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['tahun'], 'safe'],
            [['id', 'nama_unit', 'nama', 'jabatan'], 'string', 'max' => 100],
            [['pemda_id'], 'string', 'max' => 10],
            [['nip'], 'string', 'max' => 18],
            [['secret_key'], 'string', 'max' => 255],
            [['kategori_jabatan', 'post'], 'string', 'max' => 1],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKuisionerLanjutans()
    {
        return $this->hasMany(KuisionerLanjutan::className(), ['responden_id' => 'id']);
    }

    public function getUnit()
    {
        $units = Yii::$app->params['unit'];
        return \yii\helpers\ArrayHelper::getValue($units, $this->nama_unit);
    }
}
