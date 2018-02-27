<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Individu';
$this->params['breadcrumbs'][] = ['label' => 'Validasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'unit',
            'nama',
            //'nip',
            'jabatan',
            //'secret_key',
            'kategori_jabatan',
            'post',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view} {post} {validate}',
                'noWrap' => true,
                'vAlign'=>'top',
                'visibleButtons'=> [
                    'post' => function($model){
                        if($model->post === 0) return true;
                        return false;
                    },
                    'validate' => function($model){
                        if($model->post === 1) return true;
                        return false;
                    },
                ],
                'buttons' => [
                    
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'ubah'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModal",
                                 'data-title'=> "Ubah",                                 
                                 // 'data-confirm' => "Yakin menghapus ini?",
                                 // 'data-method' => 'POST',
                                 // 'data-pjax' => 1
                              ]);
                        },
                        'validate' => function ($url, $model) {
                            $validasi = \app\models\KuisionerAwalValidasi::findOne(['responden_id' => $model->id]);
                            $iconColor = "btn-default";
                            if($validasi) $iconColor = "btn-success";
                            return Html::a('<span class="glyphicon glyphicon-refresh fa-spin"></span>', $url,
                                [  
                                    'class' => "btn btn-xs $iconColor",
                                    'id' => 'validate-'.$model->id,
                                    'title' => 'Validasi',
                                    //  'data-toggle'=>"modal",
                                    //  'data-target'=>"#myModal",
                                    //  'data-title'=> "Post",                                 
                                    'data-confirm' => "Data akan divalidasi. Mungkin membutuhkan waktu agak lama. Anda yakin?",
                                    'data-method' => 'POST',
                                    'data-pjax' => 1
                                ]);
                          },
                        'post' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-check"></span>', $url,
                              [  
                                 'title' => 'Posting',
                                //  'data-toggle'=>"modal",
                                //  'data-target'=>"#myModal",
                                //  'data-title'=> "Post",                                 
                                 'data-confirm' => "Data yang sudah diposting tidak dapat diubah. Anda yakin?",
                                 'data-method' => 'POST',
                                 'data-pjax' => 1
                              ]);
                        },
                        'view' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'lihat'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModal",
                                 'data-title'=> "Lihat",
                              ]);
                        },                        
                ]
            ],
        ],
    ]); ?>
</div>
<?php 
Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ], 
    'size' => 'modal-lg',
]);
 
echo '...';
 
Modal::end();
$this->registerJs(<<<JS
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
        .done(function( data ) {
            modal.find('.modal-body').html(data)
        });
    })

    // $("a[id^='validate-']").on("click", function(event){
    //     $(this).addClass
    // })
JS
);
?>