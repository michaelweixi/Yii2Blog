<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Lookup;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'content:ntext',
            'tags:ntext',
        		[
        		'attribute'=>'status',
			'value'=>
				function($model){
			    return Lookup::item("PostStatus",$model->status);}
        		],
            //'status',
            // 'create_time:datetime',
            // 'update_time:datetime',
            'author.username',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
