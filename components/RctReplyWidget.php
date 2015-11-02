<?php 
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class RctReplyWidget extends Widget
{
	public $commentDataProvider;
	
    public function init()
    {
        parent::init();
    }

    public function run()
    {

    				
    	
		$commentString='';
		
     	foreach($this->commentDataProvider as $comment)
     	{
     		$commentString.='<div class="post">'.
							'<div class="title">'.
							'<p style="color:#777777;font-style:italic;">'.nl2br($comment->content).'</p>'.
							'<p class="text-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>'.Html::encode($comment->author).'</p>'.
							'<p style="font-size:8pt;color:blue">《 <a href="'.$comment->post->url.'">'.Html::encode($comment->post->title).'</a>》</p>'.
							'<hr></div></div>';
     	}		
	return $commentString;
    }
}

