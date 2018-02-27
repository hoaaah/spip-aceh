<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questions_list_lanjutan".
 *
 * @property int $kd_unsur
 * @property string $nama_unsur
 * @property int $kd_sub_unsur
 * @property int $id_sub_unsur
 * @property string $nama_sub_unsur
 * @property int $id
 * @property string $p_id
 * @property string $pertanyaan
 */
class QuestionsListLanjutan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions_list_lanjutan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kd_unsur', 'kd_sub_unsur', 'id', 'pertanyaan'], 'required'],
            [['kd_unsur', 'kd_sub_unsur', 'id_sub_unsur', 'id'], 'integer'],
            [['pertanyaan'], 'string'],
            [['nama_unsur', 'nama_sub_unsur'], 'string', 'max' => 255],
            [['p_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kd_unsur' => 'Kd Unsur',
            'nama_unsur' => 'Nama Unsur',
            'kd_sub_unsur' => 'Kd Sub Unsur',
            'id_sub_unsur' => 'Id Sub Unsur',
            'nama_sub_unsur' => 'Nama Sub Unsur',
            'id' => 'ID',
            'p_id' => 'P ID',
            'pertanyaan' => 'Pertanyaan',
        ];
    }
}
