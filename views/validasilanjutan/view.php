<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'View '.$responden['id'];
$this->params['breadcrumbs'][] = ['label' => 'Validasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Form 2A', 'url' => ['form2a']];
$this->params['breadcrumbs'][] = $this->title;
$heading = 'Kuisioner Survai Maturitas SPIP';
$columns = [
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
    'pertanyaan:ntext',    
];

$columns[] = [
    'header' => 'Y/T',
    'value' => function($model) use($responden){
        $jawaban = \app\models\KuisionerLanjutan::findOne(['tahun' => $responden->tahun, 'responden_id' => $responden->id, 'pemda_id' => $responden->pemda_id, 'survai_lanjutan_id' => $model->id]);
        return $jawaban['jawaban'] === 1 ? 'Y' : 'T';
    }
];
if($responden->kategori_jabatan ==5){
    $jabatan = "Staff";
}else{
    $jabatan = "Es. $responden->kategori_jabatan";
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
        'exportConfig' => [
            GridView::HTML => ['filename' => $heading,],
            GridView::CSV => ['filename' => $heading,],
            GridView::TEXT => ['filename' => $heading,],
            GridView::EXCEL => ['filename' => $heading,], 
            GridView::PDF => [
                'label' => 'PDF',
                'showHeader' => true,
                // 'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => $heading,
                'alertMsg' => 'The PDF export file will be generated for download.',
                'options' => ['title' => 'Portable Document Format'],
                'mime' => 'application/pdf',
                'config' => [
                    'mode' => 'c',
                    'format' => 'A4',
                    'orientation' => 'P',
                    'destination' => 'D',
                    'marginTop' => 20,
                    'marginBottom' => 20,
                    'cssInline' => '.kv-wrap{padding:20px;}' .
                        '.kv-align-center{text-align:center;}' .
                        '.kv-align-left{text-align:left;}' .
                        '.kv-align-right{text-align:right;}' .
                        '.kv-align-top{vertical-align:top!important;}' .
                        '.kv-align-bottom{vertical-align:bottom!important;}' .
                        '.kv-align-middle{vertical-align:middle!important;}' .
                        '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
                    'methods' => [
                        'SetHeader' => $heading,
                        'SetFooter' => 'Generated by eSPIP BPKP Aceh'//'<li role="presentation" class="dropdown-footer">Generated by eSPIP BPKP Aceh, '.date('Y-m-d H-i-s T').'</li>',
                    ],
                    'options' => [
                        'title' => $heading,
                        'subject' => 'PDF export generated by eSPIP BPKP Aceh',
                        'keywords' => 'grid, export, yii2-grid, pdf'
                    ],
                    'contentBefore'=> "<div>Nama Unit: $responden->unit </div> Jabatan: $jabatan",
                    'contentAfter'=>''
                ]
            ],
            GridView::JSON => ['filename' => $heading,],
        ],
        'panel'=>[
            'type'=>'primary', 
            'heading' => $this->title,
            'before' => "<div>Nama Unit: $responden->unit </div> Jabatan: $jabatan"
        ],
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
