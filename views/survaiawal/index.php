<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = 'Pengisian Kuisioner';
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;
?>
<h1><?= $this->title ?></h1>

<p>
    <?= Html::a ('Tambah Survai Awal', ['tambah-responden'], [
        'class' => 'btn btn-default btn-md',
        'data-toggle'=>"modal",
        'data-target'=>"#myModal",
        'data-title'=>"Tambah Data Survei Awal"
    ]) ?>
    <?= Html::a ('Ubah Survai Saya', ['ubah-survai'], [
        'class' => 'btn btn-default btn-md',
        // 'data-toggle'=>"modal",
        // 'data-target'=>"#myModal",
        // 'data-title'=>"Tambah Data Survei Awal"
    ]) ?>

    <?= $session->has('res_id') && \app\models\RespondenKuisionerAwal::findOne($session['res_id'])['post'] === 0 ? Html::a('Posting Data', ['posting'], [
        'class' => 'btn btn-danger pull-right',
        'data-method' => 'POST',
        'data-confirm' => 'Data yang sudah diposting tidak dapat diubah lagi. Anda Yakin?'
    ]) : "" ?>
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