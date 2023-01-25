<?php

namespace app\controllers;

use app\models\Cart;
use app\models\CartSearch;
use app\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
{
    /**
     * @inheritDoc
     */




    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cart models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CartSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cart model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $product_id = Yii::$app->request->post('product_id');
        $items=Yii::$app->request->post('count');
        $product = Product::findOne($product_id);
        if (!$product) return 'false';
        if ($product->count >=$items) {
            $product->count -= $items;
            $product->save(false);
            $model = cart::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['product_id' => $product_id])->one();
         if ($model) {
             $model->count += $items;
             $model->save();
             return $product->count;
         }
         $model = new cart();
         $model->user_id = \Yii::$app->user->identity->id;
         $model->product_id = $product->id;
         $model->count = $items;
         if ($model->save(false)) return $product->count;
         }
                return 'false';

    }

    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {      
        $model = $this->findModel($id);        
        $product_id=$model->product_id;
        $product=Product::findOne(['id'=>$product_id]);  
       
        if ($this->request->isPost || $model->load($this->request->post())) {
            $count=Yii::$app->request->post('Cart')['count'];
            
            if ($count>=$product->count){
                return 'false';
            }
            
            $model->count+= $count;
            $product->count -= $count;
            $model->save(false);
            $product->save(false);
            return 'true';
        }
        $product->count += $model->count;        
        $product->save(false);
        $model->count = 0;
        $model->save();
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cart::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function beforeAction($action){
        if ($action->id=='create' || $action->id=='update' ) $this->enableCsrfValidation=false;
        return parent::beforeAction($action);
    }
}
