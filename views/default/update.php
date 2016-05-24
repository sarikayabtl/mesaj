<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\mesaj\models\Mesaj */

$this->title = 'Update Mesaj: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mesajs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mesaj-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
