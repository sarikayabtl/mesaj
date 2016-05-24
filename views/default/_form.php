<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\mesaj\models\Mesaj */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="mesaj-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'icerik')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gonderen_id')->dropDownList(ArrayHelper::map($alicilar,'id' , 'username')) ?>

    <?= $form->field($model, 'alici_id')->dropDownList(ArrayHelper::map($alicilar,'id' , 'username')) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
