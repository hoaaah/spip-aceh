<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Form 2A';
$this->params['breadcrumbs'][] = ['label' => 'Validasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$columns = [
    // ['class' => 'kartik\grid\SerialColumn'],

    // 'kd_unsur',
    // 'nama_unsur',
    // 'kd_sub_unsur',
    // 'id_sub_unsur',
    // 'nama_sub_unsur',
    //'id',
    [
        'label' => 'Sub Unsur',
        'attribute' => 'nama_sub_unsur',
        'group' => true,
        'groupedRow'=>true,
        'value' => function($model){
            return $model->kd_unsur.'.'.$model->kd_sub_unsur.' '.$model->nama_sub_unsur;
        }
    ],
    'p_id',
    // 'pertanyaan:ntext',    
];
$i = 1;
foreach($respondens as $responden){
    $columns[] = [
        'header' => Html::a('R'.$i, ['view', 'id' => $responden->id]),
        'value' => function($model) use($responden){
            $jawaban = \app\models\KuisionerAwal::findOne(['tahun' => $responden->tahun, 'responden_id' => $responden->id, 'pemda_id' => $responden->pemda_id, 'survai_awal_id' => $model->id]);
            return $jawaban['jawaban'] === 1 ? 1 : "";
        }
    ];
    $i++;
}
?>
<div class="questions-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive'=>true,
        'hover'=>true,     
        'resizableColumns'=>false,
        'panel'=>['type'=>'primary', 'heading' => $this->title],
        'responsiveWrap' => false,        
        'toolbar' => [
                '{toggleData}',
                '{export}',          
        ],       
        'pager' => [
            'firstPageLabel' => 'Awal',
            'lastPageLabel'  => 'Akhir'
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'question-list-pjax', 'timeout' => 5000],
        ],
        // 'showPageSummary'=>true,   
        'columns' => $columns,
    ]); ?>
</div>
