
<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;  
use yii\widgets\DetailView;
use app\models\Lookup;
use app\models\Comment;
use app\models\app\models;

use app\components\TagsCloudWidget;
use app\components\RctReplyWidget;

$this->title = $model->title;


?>  

<div class="container">

<div class="row">

<div class="col-md-9">
		
			<ol class="breadcrumb">
			  <li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
			  <li><a href="<?= Yii::$app->homeUrl;?>?r=post/home">文章列表</a></li>
			  <li class="active"><?= $model->title?></li>
			</ol>
		

	<div class="post">
		<div class="title">
		
		<h2><a href="<?= $model->url; ?>"><?= Html::encode($model->title);?></a></h2>
		
				<div class="author">
				<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em><?= date('Y-m-d H:i',$model->create_time)."&nbsp;&nbsp;&nbsp;&nbsp;" ; ?></em>
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em><?= Html::encode($model->author->username) ; ?></em>
				</div>
		</div>
				<br>
		<div class="content">
		
		<?= HtmlPurifier::process($model->content) ?> 
		</div>
		
	
		<br>
		
	
		<div class="nav">
				<span class="glyphicon glyphicon-tag" aria-hidden="true"></span> 
				<?= implode(', ', $model->tagLinks); ?>
				<br/>
				<?= Html::a("评论 ({$model->commentCount})",$model->url.'#comments'); ?> |
				最后修改于 <?= date('Y-m-s H:i:s',$model->update_time); ?>
	
		</div>
	</div>

	
	
	<div id="comments">
	
			<?php if($added) {?>
			
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
			      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			      <h4>谢谢您的回复，我会尽快审核后将其展现出来！</h4>
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em><?= Html::encode($postModel->author) ; ?>:</em>
					<p><?php echo nl2br($postModel->content); ?></p>
					<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em><?= date('Y-m-d H:i:s',$postModel->create_time) ; ?></em>	
			    </div>

			<?php }?>  


	  
	  
	
		<?php if($model->commentCount>=1): ?>
			<h5>
				<?php echo $model->commentCount . '条评论'; ?>
			</h5>
	
			<?php echo $this->render('_comment',array(
				'post'=>$model,
				'comments'=>$model->comments,
			)); ?>
		<?php endif; ?>


		<h5>发表评论</h5>
			<?php 
			$postComment = new Comment();
			echo $this->render('/comment/_guestform',array(
					'id'=>$model->id,
				'postModel'=>$postComment,
			)); ?>
	
	</div><!-- comments -->			

	
	
</div>


<div class="col-md-3">
<div class="tags">
			
				<ul class="list-group">
		    			<li class="list-group-item">
						<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 标签
					</li>

					<li class="list-group-item">			
						<?= TagsCloudWidget::widget(['tags' => $tags]) ?>
						
						<?php 	
						/*							
						//fontstyle 用来显示不同Tag的颜色，比如<h6>用"danger"的底色
						$fontStyle=array("6"=>"danger","5"=>"info","4"=>"warning","3"=>"primary","2"=>"success");
							
						foreach($tags as $tag=>$weight)
						{	
						?>
						<a href="<?= Yii::$app->homeUrl;?>?r=post/home&PostSearch[tags]=<?=$tag;?>">
						<h<?=$weight;?> style="display: inline-block;"><span class="label label-<?= $fontStyle[$weight];?>"><?=$tag;?></span></h<?=$weight;?>>
						</a>
						<?php 	
						}	
						*/	
						?>
						
					</li>
				</ul>					
			</div>
			
			
			<div class="comments">
		
		    		<ul class="list-group">
		    			<li class="list-group-item">
					<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 最新回复
					</li>
					
					<li class="list-group-item">					
								
					<?= RctReplyWidget::widget(['commentDataProvider' => $commentDataProvider]); ?>
					
				</li>
					
					
				</ul>
			</div>

		</div>
		
	</div>
</div>
