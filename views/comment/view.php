<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Lookup;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '评论管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content:ntext',
        		[
        		'attribute'=>'status',
        		'value' => Lookup::item("CommentStatus",$model->status),
        				],
        		[
        		'attribute'=>'create_time',
        		'value' => date("Y-m-d H:i:s",$model->create_time),
        		],
            'author',
            'email:email',
            'url:url',
        		[
        		'attribute'=>'post_id',
        				'value' => $model->post->title."(ID:".$model->post_id.")",
        		],
        ],
    ]) ?>

</div>
