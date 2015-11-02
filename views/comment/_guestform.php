<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php     
    $form = ActiveForm::begin([
    'action' => ['post/detail','id' => $id, '#' => 'comments'],
    'method'=>'post',
    ]); ?>
    
    
    
		<div class="row">
		    
			<div class="col-md-4">
			<?= $form->field($postModel, 'author')->textInput(['maxlength' => true]) ?>
			</div>
			<div class="col-md-4">
			<?= $form->field($postModel, 'email')->textInput(['maxlength' => true]) ?>
			</div>
			<div class="col-md-4">
			<?= $form->field($postModel, 'url')->textInput(['maxlength' => true]) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><?= $form->field($postModel, 'content')->textarea(['rows' => 6]) ?>
			</div>
		</div>




		
    <div class="form-group">
        <?= Html::submitButton($postModel->isNewRecord ? '发 布' : '修 改', ['class' => $postModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>



