<?php 
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class TagsCloudWidget extends Widget
{
	public $tags;
	
    public function init()
    {
        parent::init();
    }

    public function run()
    {
	$tagString='';
    	//fontstyle 用来显示不同Tag的颜色，比如<h6>用"danger"的底色
    	$fontStyle=array("6"=>"danger","5"=>"info","4"=>"warning","3"=>"primary","2"=>"success");
    	
     	foreach($this->tags as $tag=>$weight)
     	{
     		$tagString.='<a href="'.\Yii::$app->homeUrl.'?r=post/home&PostSearch[tags]='.$tag.'">'.
     		' <h'.$weight.' style="display: inline-block;"><span class="label label-'.$fontStyle[$weight].'">'.$tag.'</span></h'.$weight.'></a>';
     	}		
	return $tagString;
    }
}