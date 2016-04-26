<?php

namespace backend\controllers;

use Yii;
use app\models\Post;
use app\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\Category;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */

    /*
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles'=>['@'],
                        'matchCallback' => function ($rule, $action) {

                                        $action = Yii::$app->controller->action->id;
                                        $controller = Yii::$app->controller->id;
                                        $route =  "$controller/$action";
                                        $post = Yii::$app->request->post();
                                        if(Yii::$app->user->can($route)){
                                            return true;
                                        }
                        }
                    ],
                ],
            ],
        ];
    }
    */

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    


    public function actionTest(){

        $myKey = 'postModel';
        $posts = Yii::$app->memCache->get($myKey);
        if($posts === false){
            $posts = Post::find()->asArray()->all();
            Yii::$app->memCache->set($myKey,$posts, 2000);
        }

        echo '<pre>';
        print_r($posts);
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        $catModel = new Category();

        if ($model->load(Yii::$app->request->post())) {
            
            $file = \yii\web\UploadedFile::getInstance($model, 'image');
            if (!empty($file))
                $model->image = $file;

            if($model->save()){
               if (!empty($file))
                 $file->saveAs( Yii::getAlias('@root') .'/uploads/' . $file);

                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->render('create', [
                'model' => $model,
                'catModel' => $catModel
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'catModel' => $catModel
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
        $catModel = new Category();

        if ($model->load(Yii::$app->request->post())){
           
            $file = \yii\web\UploadedFile::getInstance($model, 'image');

           if (!empty($file)){
                 $model->image= $file; 
            }
            else{
                $model->image = $model->oldAttributes['image'];
            }

           

            if($model->save())
            {

               if (!empty($file)){
                 $file->saveAs( Yii::getAlias('@root') .'/uploads/' . $file);
                 unlink(Yii::getAlias('@root') . '/uploads/'. $model->oldAttributes['image']);
               }

                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->render('update', [
                'model' => $model,
                'catModel' => $catModel
            ]);

        } else {
            return $this->render('update', [
                'model' => $model,
                'catModel' => $catModel
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
        $model = $this->findModel($id);
        if(!empty($model->image))
            unlink(Yii::getAlias('@root') . '/uploads/'. $model->image);
        $model->delete();

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
