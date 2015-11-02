<?php
use yii\helpers\Html;
use yii\widgets\ListView;  

use app\components\TagsCloudWidget;
use app\components\RctReplyWidget;
?>  
 
 <div class="container">
	<div class="row">
		<div class="col-md-9">
			<ol class="breadcrumb">
			  <li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
			  <li>文章列表</li>
			</ol>
		
				<?= ListView::widget([  
					'id' => 'postList',
				    'dataProvider' => $dataProvider,  
				    'itemView' => '_view',//子视图  
					'layout'=>'{items}{pager}',
					'pager'=>[
							'maxButtonCount'=>10,
							'nextPageLabel'=>Yii::t('app','下一页'),
							'prevPageLabel'=>Yii::t('app','上一页'),
					],
				]); 
				?>

								
								
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
