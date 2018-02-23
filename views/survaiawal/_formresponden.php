<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\RespondenKuisionerAwal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="responden-kuisioner-awal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_unit')->widget(Select2::classname(), [
        'data' => Yii::$app->params['unit'],
        'options' => ['placeholder' => 'Unit ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'secret_key')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'kategori_jabatan')->widget(Select2::classname(), [
        'data' => [
            1 => "Eselon 1",
            2 => "Eselon 2",
            3 => "Eselon 3",
            4 => "Eselon 4",
            5 => "Staff",
        ],
        'options' => ['placeholder' => 'Kategori Jabatan ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
