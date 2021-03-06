<?php

namespace app\controllers;

use Yii;
use app\models\RespondenKuisionerLanjutan;
use app\models\KuisionerLanjutan;
use app\models\RefSurvaiLanjutan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/*
 * Created on Thu Feb 22 2018
 * By Heru Arief Wijaya
 * Copyright (c) 2018 belajararief.com
 */


class UjibuktiController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'posting' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    // [
                    //     'allow' => true,
                    //     'actions' => ['login', 'signup'],
                    //     'roles' => ['?'],
                    // ],
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTambahResponden()
    {
        $session = Yii::$app->session;
        if($session->has('res_id_lanjutan')) $session->remove('res_id_lanjutan');
        $model = new RespondenKuisionerLanjutan();
        $model->tahun = Yii::$app->params['tahun'];
        $model->pemda_id = Yii::$app->params['pemda_id'];

        if ($model->load(Yii::$app->request->post())) {
            // Tambahkan uuid
            $model->id = \thamtech\uuid\helpers\UuidHelper::uuid();
            $model->secret_key = Yii::$app->getSecurity()->generatePasswordHash($model->secret_key);
            
            $update = Yii::$app->db->createCommand("
                INSERT INTO responden_kuisioner_lanjutan VALUES
                (
                    :id, :tahun, :pemda_id, :nama_unit, :nama, :nip, :jabatan, :secret_key, :kategori_jabatan, 0
                )
            ", [
                ':id' => $model->id,
                ':tahun' => $model->tahun,
                ':pemda_id' => $model->pemda_id,
                ':nama_unit' => $model->nama_unit,
                ':nama' => $model->nama,
                ':nip' => $model->nip,
                ':jabatan' => $model->jabatan,
                ':secret_key' => $model->secret_key,
                ':kategori_jabatan' => $model->kategori_jabatan
            ]);
            
            // if(!$model->validate()) return false;
            // if($model->save()){
            if($update->execute()){
                $session['res_id_lanjutan'] = $model->id;
                return $this->redirect(['kuisioner-lanjutan']);
            }
            return false;
        }

        return $this->renderAjax('_formresponden', [
            'model' => $model,
        ]);
    }

    public function actionUbahSurvai()
    {
        $session = Yii::$app->session;
        // check if session exist first, if not back to index
        if($session->has('res_id_lanjutan')) return $this->redirect(['kuisioner-lanjutan']);

        $model = new \app\models\LoginRespondenLanjutan();
        if ($model->load(Yii::$app->request->post())) {
            if($model->login()){
                var_dump($model->nip);
                $responden = RespondenKuisionerLanjutan::findOne(['nip' => $model->nip]);
                $session = Yii::$app->session;
                $session['res_id_lanjutan'] = $responden->id;
                return $this->redirect(['kuisioner-lanjutan']);
            }
        }

        return $this->render('_formlogin', [
            'model' => $model,
        ]);
    }

    public function actionKuisionerLanjutan(){
        // return "OYE";
        $session = Yii::$app->session;
        // check if session exist first, if not back to index
        if(!$session->has('res_id_lanjutan')) return $this->redirect(['index']);
        // find Responden
        $responden_id = $session['res_id_lanjutan'];
        $responden = $this->findResponden($responden_id);

        $tahun = Yii::$app->params['tahun'];
        $pemda_id = Yii::$app->params['pemda_id'];

        // create KuisionerLanjutan Class
        $model = new KuisionerLanjutan();
        $model->tahun = $tahun;
        $model->pemda_id = $pemda_id;
        $model->responden_id = $responden_id;

        // Generate all Question
        // $questions = RefSurvaiLanjutan::find()->all();
        $questions = Yii::$app->db->createCommand("SELECT a.id, b.id AS subunsur_id, b.name AS subunsur, a.p_id, a.pertanyaan FROM ref_survai_lanjutan AS a INNER JOIN ref_sub_unsur AS b ON a.sub_unsur_id = b.id ")->queryAll();
        // return var_dump($questions);

        if ($model->load(Yii::$app->request->post())) {
            if($responden->post === 1){
                Yii::$app->session->setFlash('danger', "Data anda tidak dapat disimpan karena sudah diposting.");
                return $this->redirect(['index']);
            }
            // return var_dump($model);
            foreach($model->jawabanArray as $key => $value){
                // return var_dump($key.$value);
                $jawaban = KuisionerLanjutan::findOne(['tahun' => $tahun, 'responden_id' => $responden_id, 'pemda_id' => $pemda_id, 'survai_lanjutan_id' => $key]);
                if(!$jawaban){
                    $jawaban = new KuisionerLanjutan();
                    $survaiAwalRef = RefSurvaiLanjutan::findOne($key);
                    $jawaban->id = \thamtech\uuid\helpers\UuidHelper::uuid();
                    $jawaban->p_id = $survaiAwalRef->p_id;
                    $jawaban->tahun = $tahun;
                    $jawaban->responden_id = $responden_id;
                    $jawaban->pemda_id = $pemda_id;
                    $jawaban->survai_lanjutan_id = $key;
                }
                $jawaban->jawaban = $value;
                // return var_dump($jawaban->validate());
                $jawaban->save();
                unset($jawaban);
            }

        }

        return $this->render('_formkuisioner', [
            'model' => $model,
            'questions' => $questions,
            'responden_id' => $responden_id,
            'responden' => $responden
        ]);
    }

    public function actionPosting()
    {
        $session = Yii::$app->session;
        // check if session exist first, if not back to index
        if(!$session->has('res_id_lanjutan')) return $this->redirect(['index']);

        $model = $this->findResponden($session['res_id_lanjutan']);
        $model->post = 1;
        // return var_dump($model->validate());
        // return var_dump($model);
        $update = Yii::$app->db->createCommand("UPDATE responden_kuisioner_lanjutan SET post = 1 WHERE id = :res_id", [':res_id' => $session['res_id_lanjutan']]);
        // if($model->save()){
        if($update->execute()){
            Yii::$app->session->setFlash('success', "Data anda telah diposting.");
            return $this->redirect(['index']);
        }else{
            Yii::$app->session->setFlash('warning', "Something was wrong.");
            return $this->redirect(['index']);
        }
        
    }

    protected function findResponden($id)
    {
        if (($model = RespondenKuisionerLanjutan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
