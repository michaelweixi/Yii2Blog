<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Lookup;
use app\models\Comment;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
				    <?php /* echo $this->render('_search', ['model' => $searchModel]); 
				
				   // <p>
				   //     <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
				   // </p>
					*/?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
        		[
        				'attribute'=>'content',
        				'format'=>'ntext',
        				'contentOptions'=>['width'=>"460px"],
        		],
           
        		[
	        		'attribute'=>'status',
	        		'value'=>
		        		function($model){
		        		return Lookup::item("CommentStatus",$model->status);
		        		}, 
		        	'contentOptions'=>
		        	function($model){
		        		return $model->status==Comment::STATUS_PENDING?['class'=>'bg-danger',]:[];
		        		}, 
		        		
		     ],

		        [
		        'attribute' => 'create_time',
		        'format' => ['date', 'php:Y-m-d H:i:s']
		        ],
		        
		        
            'author',
            // 'email:email',
            // 'url:url',
            
             //post_id',
	        	'post.title',

            [
            		'class' => 'yii\grid\ActionColumn',
            		'template' => '{view} {update} {delete} {approve}',
            		'buttons' => [
            				// 自定义按钮
            				'approve' => function ($url, $model, $key) {
            					$options = [
            							'title' => Yii::t('yii', '审核'),
            							'aria-label' => Yii::t('yii', '审核'),
            							'data-pjax' => '0',
            					];
            					return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, $options);
            				},
            				],
            				
            		
    			],
        ],
    ]); ?>

</div>
