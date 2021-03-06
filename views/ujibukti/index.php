<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = 'Pengisian Kuisioner Lanjutan';
$this->params['breadcrumbs'][] = 'Pengujian Bukti Maturitas';
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;
?>
<h1><?= $this->title ?></h1>

<p>
    <?= Html::a ('Tambah Survai Lanjutan', ['tambah-responden'], [
        'class' => 'btn btn-default btn-md',
        'data-toggle'=>"modal",
        'data-target'=>"#myModal",
        'data-title'=>"Tambah Data Survei Awal"
    ]) ?>
    <?= Html::a ('Ubah Survei Saya', ['ubah-survai'], [
        'class' => 'btn btn-default btn-md',
        // 'data-toggle'=>"modal",
        // 'data-target'=>"#myModal",
        // 'data-title'=>"Tambah Data Survei Awal"
    ]) ?>

    <?= $session->has('res_id_lanjutan') ? 
        Html::a('<i class="glyphicon glyphicon-print"></i> Cetak Kuisioner', ['/validasi/view', 'id' => $session['res_id_lanjutan']], [
            'class' => 'btn btn-info pull-right',
            // 'data-method' => 'POST',
            // 'data-confirm' => 'Data yang sudah diposting tidak dapat diubah lagi. Anda Yakin?'
        ]) 
    : "" ?>

    <?= $session->has('res_id_lanjutan') && \app\models\RespondenKuisionerLanjutan::findOne($session['res_id_lanjutan'])['post'] === 0 ? 
        Html::a('<i class="glyphicon glyphicon-check"></i> Posting Data', ['posting'], [
            'class' => 'btn btn-danger pull-right',
            'data-method' => 'POST',
            'data-confirm' => 'Data yang sudah diposting tidak dapat diubah lagi. Anda Yakin?'
        ]) 
    : "" ?>

</p>

<?php 
Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    'size' => 'modal-lg',
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ], 
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
JS
);
?>