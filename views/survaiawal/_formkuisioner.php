<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\RespondenKuisionerAwal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="responden-kuisioner-awal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $subUnsurId = null;
        foreach($questions AS $question){ 
            if($subUnsurId === null){
                echo '
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">'.$question['subunsur_id'].'. '.$question['subunsur'].'</h3>
                    </div>
                    <div class="panel-body">                
                ';
            }
            if($subUnsurId != $question['subunsur_id'] && $subUnsurId !== null){
                if($responden->post !== 1) echo Html::submitButton('Save', ['class' => 'btn btn-success']);
                echo "</div></div>";
                echo '
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">'.$question['subunsur_id'].'. '.$question['subunsur'].'</h3>
                    </div>
                    <div class="panel-body">                
                ';
            }
            if(\app\models\KuisionerAwal::findOne(['responden_id' => $responden_id, 'survai_awal_id' => $question['id']]))
                $model->jawabanArray[$question['id']] = \app\models\KuisionerAwal::findOne(['responden_id' => $responden_id, 'survai_awal_id' => $question['id']])['jawaban'];
            echo $form->field($model, 'jawabanArray['.$question['id'].']')->widget(SwitchInput::classname(), [
                'id' => 'question-'.$question['id'],
                'pluginOptions' => [
                    // 'size' => 'large',
                    'onText' => 'Ya',
                    'offText' => 'Tidak',
                ]
            ])->label($question['pertanyaan']);

            $subUnsurId = $question['subunsur_id'];
        }
        echo "</div></div>";
    ?>

    <div class="form-group">
        <?= $responden->post !== 1 ? Html::submitButton('Save', ['class' => 'btn btn-success'])  : ''?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
