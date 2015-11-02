<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\PostSearch;
use app\models\Comment;
use app\models\Tag;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
	public $added=0;//当有新回复时，变为1。为1时，view会展示待审核信息。
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'], //post get,不是文章post
                ],
            ],
        		
        	'access' => [
        				'class' => AccessControl::className(),
        				'only' => ['create', 'update', 'delete'],
        				'rules' => [
        						// 允许认证用户
        						[
        								'allow' => true,
        								'roles' => ['@'],
        						],
        						// 默认禁止其他用户
        				],
        		],
        		
        		
        ];
    }

    /**
     * Guest user home page.
     * @return mixed
     */
    public function actionHome()
    {
    	$tags=Tag::findTagWeights(Yii::$app->params['tagCloudCount']);

    	$searchModel = new PostSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    	$commentModel = new Comment();
    	$commentDataProvider = $commentModel->findRecentComments(Yii::$app->params['recentCommentCount']);
    	
    	return $this->render('home', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			'commentDataProvider' => $commentDataProvider,
    			'tags' => $tags,
    	]);
    }
    
    
    
    /**
     * Displays a post detail.
     * @param integer $id
     * @return mixed
     */
    public function actionDetail($id)
    {
    	$postModel = new Comment();

    	if ($postModel->load(Yii::$app->request->post()))
	    	{
		    	$postModel->status=Comment::STATUS_PENDING;
		    	$postModel->post_id=$id;
		    	if ($postModel->save()) 
			    	{
			    		$this->added=1;	
			    	}	
	    	}
   		
    	$tags=Tag::findTagWeights(Yii::$app->params['tagCloudCount']);
    	
    	$commentModel = new Comment();
    	$commentDataProvider = $commentModel->findRecentComments(Yii::$app->params['recentCommentCount']);//Yii::$app->params['recentCommentCount']
    	
    	return $this->render('detail', [
    			'model' => $this->findModel($id),
    			'commentDataProvider' => $commentDataProvider,
    			'tags' => $tags,
    			'postModel'=>$postModel,
    			'added'=>$this->added,
    	]);
    	
    }
    
    
     
    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        foreach ($dataProvider->models as $xjj)
        {
        Tag::updateFrequency('', $xjj->tags);
        }
        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();       
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
