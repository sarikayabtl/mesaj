<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\mesaj\models\Mesaj */

$this->title = 'Create Mesaj';
$this->params['breadcrumbs'][] = ['label' => 'Mesajs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesaj-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'alicilar' => $alicilar
    ]) ?>

</div>
