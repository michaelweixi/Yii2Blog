<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 *
 * @property TblPost $post
 */
class Comment extends \yii\db\ActiveRecord
{
	
	const STATUS_PENDING=1;
	const STATUS_APPROVED=2;
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status', 'author', 'email', 'post_id'], 'required'],
            [['content'], 'string'],
            [['status', 'create_time', 'post_id'], 'integer'],
            [['author', 'email', 'url'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'status' => '状态',
            'create_time' => '发表时间',
            'author' => '作者',
            'email' => '邮箱',
            'url' => '网址',
            'post_id' => '文章',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
    

    
    /**
     * @param Post the post that this comment belongs to. If null, the method
     * will query for the post.
     * @return string the permalink URL for this comment
     */
    public function getUrl($post=null)
    {
	    	if($post===null)
	    		$post=$this->post;
	    	return $post->url.'#c'.$this->id;
    }
    
    public static function getPengdingCommentCount()
    {
    	return Comment::find()->where(['status' => Comment::STATUS_PENDING])->count();
    }
    
    
    
    /**
     * @return string the hyperlink display for the current comment's author
     */
    public function getAuthorLink()
    {
	    	if(!empty($this->url))
	    		return CHtml::link(CHtml::encode($this->author),$this->url);
	    	else
	    		return CHtml::encode($this->author);
    }
    
    /**
     * @return integer the number of comments that are pending approval
     */
    public static function getPendingCommentCount()
    {
	    	return $this->count('status='.self::STATUS_PENDING);
    }
    
    /**
     * @param integer the maximum number of comments that should be returned
     * @return array the most recently added comments
     */
    public function findRecentComments($limit=10)
    {
    	
    	$query = Comment::find()
    	->where(['status' => Comment::STATUS_APPROVED])
    	->orderBy('create_time DESC')
    	->limit($limit)
    	->all();
 	
    	return $query;

	}
    
    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    
    public function beforeSave($insert)
    {
    	if (parent::beforeSave($insert)) {
    		if($insert) {
    			$this->create_time=time();
    		} 
    		return true;
    }
    else
    	return false;
    }
    
    
    
}
