<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\mesaj\models\MesajSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mesajs';
$this->params['breadcrumbs'][] = $this->title;
?>

	<div class="row" style="background-color:#E9EBEE;border:3px solid #4285F3;border-radius:30px;padding:20px">
		<div class="col-md-8" style="background-color:white;border:3px solid #4285F3;border-radius:30px;margin:20px">
			
			<?php if(isset($mesajlar))
			{
			?>
			<h4><?= $kullanici->username?></h4>
			<?php foreach ($mesajlar as $mesaj):?>
			<div class="row" style="padding:5px 15px 5px 15px;">
				<?php if($mesaj->gonderen->id == yii::$app->user->id)
				{?>
					<div style="border:1px black solid;margin:5px;background-color:#F5F5F5;border-radius:10px;float:right;padding:5px;">
				<?php }else {?>
					<div style="border:1px black solid;margin:5px;background-color:#F5F5F5;border-radius:10px;float:left;padding:5px;">
					<?php }?>
					<?= $mesaj->icerik ?>
					<div style="float:right;margin-top:20px;display:block;"><?= $mesaj->gonderen->username?></div>
				</div>
				
			</div>
			
				
				
			<?php endforeach;?>
				<?php $form = ActiveForm::begin(); ?>
				<?= $form->field($model, 'icerik'); ?>
				<?= Html::submitButton( 'Gonder' ,['class' =>  'btn btn-success' ]) ?>
				 <?php ActiveForm::end(); ?>

			<?php 
			}else{

			?>
			Konusmaya baslamak icin kullanıcıya tıklayınız
			<?php }?>
			
		</div>
		<div class="col-md-3">
			<?php foreach ($users as $user):?>
				<?php if($user->id == yii::$app->user->id)
						continue;?>
				<a href="http://mesaj.com/mesaj/default/index?id=<?= $user->id?>"><?= $user->username?></a>
			<?php endforeach;?>
		</div>
	</div>
