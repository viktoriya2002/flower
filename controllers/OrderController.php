<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\OrderSearch;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function beforeAction($action)
    {
        if ($action->id == 'create')
            $this->enableCsrfValidation = false;
        
        if ((\Yii::$app->user->isGuest) || (\Yii::$app->user->identity->admin == 0)&& $action->id=='update') {
            $this->redirect(['site/login']);
        }
        return parent::beforeAction($action);       
    }

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
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
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
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {   $id=4;//\Yii::$app->user->identity->id;
        $user=User::findOne(4);//\Yii::$app->user->identity;
        $password=\Yii::$app->request->post('password');
       // die($user->password);
        if ($user->password==$password) {} else return 'false';

        $carts = Cart::find()->where(['user_id' => $id])->all();
        foreach ($carts as $cart){
            $order=new Order();
            $order->user_id=$id;
            $order->product_id=$cart->product_id;
            $order->count=$cart->count;
            $order->save(false);
            $cart->delete();
        }
        return $id;
     //   $this->redirect('../order/index?OrderSearch[user_id]='.$id);

//        $model = new Order();
//
//        if ($this->request->isPost) {
//            if ($model->load($this->request->post()) && $model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
//        } else {
//            $model->loadDefaultValues();
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       $model=$this->findModel($id);
        if ($model->status == 'Подтвержден' || $model->status == 'Отменен') 
        return "<h1>Ошибка</h1>
        <h3>Невозможно удалить заказ<h3>
        <button class='btn btn-success' onclick='history.back()'>Вернуться назад</button>";
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
