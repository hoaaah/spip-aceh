<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RespondenKuisionerAwal */

$this->title = 'Create Responden Kuisioner Awal';
$this->params['breadcrumbs'][] = ['label' => 'Responden Kuisioner Awals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="responden-kuisioner-awal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
