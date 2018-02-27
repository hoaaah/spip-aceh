<?php

namespace app\controllers;

use Yii;
use app\models\RespondenKuisionerLanjutan;
use app\models\KuisionerAwal;
use app\models\KuisionerAwalValidasi;
use app\models\RefSurvaiAwal;
use app\models\QuestionLanjutanSearch;
use app\models\RespondenLanjutanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/*
 * Created on Thu Feb 22 2018
 * By Heru Arief Wijaya
 * Copyright (c) 2018 belajararief.com
 */


class ValidasilanjutanController extends \yii\web\Controller
{
    private $tahun;
    private $pemda_id;
    
    public function beforeAction($action)
    {
        // your custom code here, if you want the code to run before action filters,
        // which are triggered on the [[EVENT_BEFORE_ACTION]] event, e.g. PageCache or AccessControl
        $this->tahun = Yii::$app->params['tahun'];
        $this->pemda_id = Yii::$app->params['pemda_id'];
        
        // return var_dump($action->id);
        if($action->id !== 'view'){
            if(Yii::$app->user->identity->username !== 'admin'){
                Yii::$app->session->setFlash('warning', "You didn't have access.");
                return $this->redirect(['/ujibukti']);
            }
        }
    
        if (!parent::beforeAction($action)) {
            return false;
        }
    
        // other custom code here
        
        return true; // or false to not run the action
    }    


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'post' => ['POST'],
                    // 'validate' => ['POST'],
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
        $respondens = RespondenKuisionerLanjutan::findAll(['tahun' => $this->tahun, 'pemda_id' => $this->pemda_id]);

        return $this->render('index', [
            'respondens' => $respondens,
        ]);
    }

    public function actionForm2a()
    {
        $searchModel = new QuestionLanjutanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 0;
        $respondens = RespondenKuisionerLanjutan::findAll(['tahun' => $this->tahun, 'pemda_id' => $this->pemda_id, 'post' => 1]);

        return $this->render('form2a', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'respondens' => $respondens,
        ]);
    }

    public function actionForm2avalidasi()
    {
        $searchModel = new QuestionLanjutanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 0;
        $respondens = RespondenKuisionerLanjutan::findAll(['tahun' => $this->tahun, 'pemda_id' => $this->pemda_id, 'post' => 1]);

        return $this->render('form2avalidasi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'respondens' => $respondens,
        ]);
    }

    public function actionView($id)
    {
        $searchModel = new QuestionLanjutanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 0;
        $responden = $this->findResponden($id);

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('view', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'responden' => $responden,
            ]);    
        }

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'responden' => $responden,
        ]);
    }

    public function actionUbah($id)
    {
        $session = Yii::$app->session;
        $session['res_id'] = $id;
        return $this->redirect(['/ujibukti/kuisioner-lanjutan']);
    }

    public function actionIndividu()
    {
        $searchModel = new RespondenLanjutanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('individu', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPost($id)
    {
        $model = $this->findResponden($id);
        $model->post = 1;
        $update = Yii::$app->db->createCommand("UPDATE responden_kuisioner_awal SET post = 1 WHERE id = :res_id", [':res_id' => $id]);
        if($update->execute()){
            Yii::$app->session->setFlash('success', "Data anda telah diposting.");
            return $this->redirect(['individu']);
        }else{
            Yii::$app->session->setFlash('warning', "Something was wrong.");
            return $this->redirect(['individu']);
        }   
    }

    public function actionValidate($id)
    {
        $model = $this->findResponden($id);
        $model->post = 1;
        // check if exist first
        $validasi = KuisionerAwalValidasi::findOne(['responden_id' => $model->id]);
        // delete if exist
        if($validasi) KuisionerAwalValidasi::deleteAll(['responden_id' => $model->id]);
        $kuisionerAwal = Yii::$app->db->createCommand("SELECT b.id AS question_id, b.sub_unsur_id, a.* FROM kuisioner_awal a INNER JOIN ref_survai_awal b ON a.survai_awal_id = b.id WHERE a.responden_id = :res_id ORDER BY b.sub_unsur_id, b.id ASC", [':res_id' => $id])->queryAll();
        // return var_dump($kuisionerAwal);
        
        $lastSubUnsurId = 0;
        $jawabanSebelum = 1;
        foreach($kuisionerAwal as $data){
            if($lastSubUnsurId != $data['sub_unsur_id']) $jawabanSebelum = 1;
            Yii::$app->db->createCommand("INSERT INTO kuisioner_awal_validasi VALUES(:id, :tahun, :responden_id, :pemda_id, :survai_awal_id, :p_id, :jawaban )", [
                ':id' => $data['id'],
                ':tahun' => $data['tahun'],
                ':responden_id' => $data['responden_id'],
                ':pemda_id' => $data['pemda_id'],
                ':survai_awal_id' => $data['survai_awal_id'],
                ':p_id' => $data['p_id'],
                ':jawaban' => $jawabanSebelum == 0 ? 0 : $data['jawaban'],
            ])->execute();
            if($jawabanSebelum != 0) $jawabanSebelum = $data['jawaban'];
            $lastSubUnsurId = $data['sub_unsur_id'];
            // return var_dump($lastSubUnsurId);
        }
        Yii::$app->session->setFlash('success', "Data anda telah divalidasi.");
        return $this->redirect(['individu']);        
        // Then insert it
        // $update = Yii::$app->db->createCommand("INSERT INTO kuisioner_awal_validasi ( SELECT * FROM kuisioner_awal WHERE responden_id = :res_id )", [':res_id' => $id]);
        // if($update->execute()){
        //     Yii::$app->session->setFlash('success', "Data anda telah divalidasi.");
        //     return $this->redirect(['individu']);
        // }else{
        //     Yii::$app->session->setFlash('warning', "Something was wrong.");
        //     return $this->redirect(['individu']);
        // }
        
    }

    protected function findResponden($id)
    {
        if (($model = RespondenKuisionerLanjutan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
