<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Comment;

AppAsset::register($this);

$pendingCommentCount=Comment::getPengdingCommentCount();


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">


<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
<style type="text/css">
.navbar-inverse .navbar-brand {
  color: #fff;
}
</style>   	

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'YII2博客',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
					    ['label' => '首页', 'url' => ['/post/home']],	

        					
        					[
        					'label' => '文章管理',
        					'url' => ['/post/index'],
        					'visible' => !Yii::$app->user->isGuest
        					],
        					
        					[
        					'label' => '评论管理',
        					'url' => ['/comment/index'],
        					'visible' => !Yii::$app->user->isGuest
        					],      		
        						Yii::$app->user->isGuest ?
        						'':	'<li><span class="badge badge-inverse">'.$pendingCommentCount.'</span></li>',
        					[
        					'label' => '博客参数',
        					'url' => ['/comment/index'],
        					'visible' => !Yii::$app->user->isGuest
        					],
        	     		
			        		        		
						['label' => '关于博主', 'url' => ['/site/about']],
					     Yii::$app->user->isGuest ?
			                ['label' => '登录', 'url' => ['/site/login']] :
			                [
			                    'label' => '退出 (' . Yii::$app->user->identity->username . ')',
			                    'url' => ['/site/logout'],
			                    'linkOptions' => ['data-method' => 'post']
			                ],
        				],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">A Yii2.0 blog demo</p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
