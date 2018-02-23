<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RespondenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="responden-kuisioner-awal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'pemda_id') ?>

    <?= $form->field($model, 'nama_unit') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'nip') ?>

    <?php // echo $form->field($model, 'jabatan') ?>

    <?php // echo $form->field($model, 'secret_key') ?>

    <?php // echo $form->field($model, 'kategori_jabatan') ?>

    <?php // echo $form->field($model, 'post') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
