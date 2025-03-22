<?php

namespace app\modules\shop\controllers;

use app\models\Cart;
use app\models\CartItem;
use app\models\Order;
use app\models\OrderShop;
use app\models\OrderShopItem;
use app\models\Status;
use app\modules\shop\models\OrderShopSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * OrderController implements the CRUD actions for OrderShop model.
 */
class OrderController extends Controller
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
     * Lists all OrderShop models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderShopSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderShop model.
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
     * Creates a new OrderShop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($cart_id)
    {
        $model = new OrderShop();        
        $dataProvider = (new OrderShopSearch())->orderCreate($cart_id);

        if ($this->request->isPost) {
            
            if ($model->load($this->request->post()) ) {
                $cart = Cart::findOne($cart_id);
                $model->status_id = Status::getStatusId('Новая');
                $model->load($cart->attributes, '');
                $model->save();
                // VarDumper::dump($cart->attributes, 10, true); 
                // VarDumper::dump($model->attributes, 10, true); die;
                $cartItems = CartItem::find()
                    ->where(['cart_id' => $cart->id])
                    ->all();
                foreach($cartItems as $cartItem) {
                    $shopItem = new OrderShopItem();
                    $shopItem->load($cartItem->attributes, '');
                    $shopItem->order_shop_id = $model->id;
                    $shopItem->save();
                }

                $cart->delete();
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing OrderShop model.
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
     * Deletes an existing OrderShop model.
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
     * Finds the OrderShop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return OrderShop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderShop::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
