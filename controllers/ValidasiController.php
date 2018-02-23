<?php

namespace app\controllers;

use Yii;
use app\models\RespondenKuisionerAwal;
use app\models\KuisionerAwal;
use app\models\RefSurvaiAwal;
use app\models\QuestionSearch;
use app\models\RespondenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/*
 * Created on Thu Feb 22 2018
 * By Heru Arief Wijaya
 * Copyright (c) 2018 belajararief.com
 */


class ValidasiController extends \yii\web\Controller
{
    private $tahun;
    private $pemda_id;
    
    public function beforeAction($action)
    {
        // your custom code here, if you want the code to run before action filters,
        // which are triggered on the [[EVENT_BEFORE_ACTION]] event, e.g. PageCache or AccessControl
        $this->tahun = Yii::$app->params['tahun'];
        $this->pemda_id = Yii::$app->params['pemda_id'];
    
        if (!parent::beforeAction($action)) {
            return false;
        }
    
        // other custom code here
    
        return true; // or false to not run the action
    }    


    public function behaviors()
    {
        return [
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
        $respondens = RespondenKuisionerAwal::findAll(['tahun' => $this->tahun, 'pemda_id' => $this->pemda_id]);

        return $this->render('index', [
            'respondens' => $respondens,
        ]);
    }

    public function actionForm2a()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 0;
        $respondens = RespondenKuisionerAwal::findAll(['tahun' => $this->tahun, 'pemda_id' => $this->pemda_id]);

        return $this->render('form2a', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'respondens' => $respondens,
        ]);
    }

    public function actionView($id)
    {
        $searchModel = new QuestionSearch();
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

    public function actionIndividu()
    {
        $searchModel = new RespondenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('individu', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findResponden($id)
    {
        if (($model = RespondenKuisionerAwal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
