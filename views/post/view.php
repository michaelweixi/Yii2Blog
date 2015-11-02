<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Lookup;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], [
        		'class' => 'btn btn-primary']) ?>
        
        
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'tags:ntext',
        		[
        		'attribute'=>'status',
        		'value' => Lookup::item("PostStatus",$model->status),
        		],
        		[
        		'attribute'=>'create_time',
        		'value' => date("Y-m-d H:i:s",$model->create_time),
        		],
        		[
        		'attribute'=>'update_time',
        		'value' => date("Y-m-d H:i:s",$model->update_time)
        		],
       		
        		[
        		'attribute'=>'author_id',
        		'value' => $model->author->username,
        		],
        		
        ],
    ]) ?>

</div>
