<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
	const FONT_SIZE_LEVEL=5;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '标签',
            'frequency' => '频率',
        ];
    }
    
    public static function string2array($tags)
    {
    	return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
    }
    
    public static function array2string($tags)
    {
    	return implode(', ',$tags);
    }
    
    /**
     * 返回格式
	 *["Gii"]=>3
	 *["GridView"]=>4
	 *["RESTful Web服务"]=>4
	 * 值用于<h？>标签，显示不同大小    
	*/
    public static function findTagWeights($limit=20)
    {
    	$models=Tag::find()
    		->orderBy('frequency DESC')
    		->limit($limit)   		
    		->all();

    	$total=Tag::find()
    		->orderBy('frequency DESC')
    		->limit($limit)   		
    		->count();
    	
    	$stepper=ceil($total/Tag::FONT_SIZE_LEVEL); //把标签按个数，平均分组
    
    	$tags=array();
    	$counter=1;
    	
    	if($total>0)
    	{
    		foreach($models as $model)
	    		{
	    			$weight=ceil($counter/$stepper)+1;
	    			$tags[$model->name]=$weight;
	    			$counter++;
	    		}		
    		ksort($tags);
    	}
    	return $tags;
    }
    
    

    public function updateFrequency($oldTags, $newTags)
    {	
	    	$oldTags=self::string2array($oldTags);

	    	$newTags=self::string2array($newTags);
	    	
	    	self::addTags(array_values(array_diff($newTags,$oldTags)));
	    	self::removeTags(array_values(array_diff($oldTags,$newTags)));
    }
    
    public function addTags($tags)
    {
	    	foreach($tags as $name)
	    	{
	    		$aTag = Tag::find()
	    		->where(['name' => $name])
	    		->one();
	    		
	    		$aTagCount = Tag::find()
	    		->where(['name' => $name])
	    		->count();
	    		
	    		
	    		if(!$aTagCount)
	    		{
	    			$tag=new Tag;
	    			$tag->name=$name;
	    			$tag->frequency=1;
	    			$tag->save();
	    		}
	    		else 
	    		{
	    			$aTag->frequency+=1;
	    			$aTag->save();
	    		}
	    	}
    }
    
    public function removeTags($tags)
    {
	    	if(empty($tags)) return;

	    	foreach($tags as $name)
	    	{
	    		$aTag = Tag::find()
	    		->where(['name' => $name])
	    		->one();
	    		
	    		$aTagCount = Tag::find()
	    		->where(['name' => $name])
	    		->count();
	    		 
	    		if($aTagCount)
		    		{
			    		if($aTagCount && $aTag->frequency<=1)
			    		{
			    			$aTag->delete();
			    		}
			    		else
			    		{
			    			$aTag->frequency-=1;
			    			$aTag->save();
			    		}
		    		}
	    		 
	    	}

    }
    
    
    
    
}
