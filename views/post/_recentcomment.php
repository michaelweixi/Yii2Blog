<?php
use yii\helpers\Html;
?>

<div class="post">
	<div class="title">
	<?= Html::tag('p', Html::encode($model->content), ['style' => 'color:#777777;font-style:italic;']) ?>
	<p class="text-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?= Html::encode($model->author);?></p>
	<p style="font-size:8pt;color:blue">《 <?= Html::encode($model->post->title);?>》</p>
	</div>
	
</div>
<hr>