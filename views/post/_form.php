<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Lookup;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'status')->dropDownList(Lookup::items('PostStatus')) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? ' 新 增 ' : '修 改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
