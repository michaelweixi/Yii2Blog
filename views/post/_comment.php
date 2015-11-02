<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>


<?php foreach($comments as $comment): ?>
<div class="comment">

<div class="row">
  <div class="col-md-12">
  
	  <div class="comment_detail">
	  <p class="bg-info">
	  
	  	<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em><?= Html::encode($comment->author) ; ?>:</em>
		
	    <br>
		
			
	  <?php echo nl2br($comment->content); ?>
	  
	  <br>
	  
	  	<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em><?= date('Y-m-d H:i:s',$comment->create_time); ?></em>
			
		
		
	  </p>
	  </div>
  </div>

  </div>

</div><!-- comment -->
<?php endforeach; ?>
