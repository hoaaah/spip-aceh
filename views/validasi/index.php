<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = 'Validasi';
$this->params['breadcrumbs'][] = 'Survei Awal';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>survaiawal/index</h1>

<p>
    <?= Html::a ('Kuisioner Individu', ['individu'], [
        'class' => 'btn btn-default btn-md',
    ]) ?>
    <?= Html::a ('Form 2A', ['form2a'], [
        'class' => 'btn btn-default btn-md',
    ]) ?>
    <?= Html::a ('Form 2A Tervalidasi', ['form2avalidasi'], [
        'class' => 'btn btn-default btn-md',
    ]) ?>
    <?= Html::a ('Form 2B', ['form2b'], [
        'class' => 'btn btn-default btn-md',
    ]) ?>
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