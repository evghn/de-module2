<?php

namespace app\modules\shop\controllers;

use app\models\Cart;
use app\models\CartItem;
use app\models\Product;
use app\modules\shop\models\CartSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
{
    /**
     * @inheritDoc
     */
    // public function behaviors()
    // {
    //     return array_merge(
    //         parent::behaviors(),
    //         [
    //             'verbs' => [
    //                 'class' => VerbFilter::className(),
    //                 'actions' => [
    //                     'delete' => ['POST'],
    //                 ],
    //             ],
    //         ]
    //     );
    // }

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
     * Deletes an existing Cart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionClear($id)
    {
        if ($model = $this->findModel($id)) {

            $model->delete();
            return $this->asJson(true);
        }

        return $this->asJson(false);
    }


    public function actionCount()
    {
        if ($model = Cart::findOne(['user_id' => Yii::$app->user->id])) {
            return $this->asJson([
                'status' => true,
                'value' => CartItem::find()
                    ->where([
                        'cart_id' => $model->id,                    
                    ])
                    ->sum('amount')
            ]);
        } else {
            return $this->asJson([
                'status' => true,
                'value' => 0
            ]);
        }
    }


    public function actionAdd($id)
    {
        $model = Cart::findOne(['user_id' => Yii::$app->user->id]);
        $product = Product::findOne($id);
        if ($product && $product->amount) {
            if (!$model) {
                $model = new Cart();
                $model->user_id = Yii::$app->user->id;
                $model->save();
            }

            $cartItem = CartItem::findOne(['cart_id' => $model->id, 'product_id' => $id]);

            if (!$cartItem) {
                // добавление нового товара в корзину
                $cartItem = new CartItem();
                $cartItem->cart_id = $model->id;
                $cartItem->product_id = $product->id;
                
            }

            if ($product->amount < $cartItem->amount + 1) {
                VarDumper::dump(__LINE__); die;
                return $this->asJson(false);
            }

            $cartItem->amount++;
            $cartItem->cost += $product->cost;
            if (!$cartItem->save()) {
               VarDumper::dump($cartItem->errors, true, 10); die;
            }
            
            $model->amount++;
            $model->cost += $product->cost;
            $model->save();

            return $this->asJson(true);
        }

    } 


    public function actionItemRemove($id)
    {
        if ($model = CartItem::findOne($id)) {
            $model->delete();
            return $this->asJson(true);
        } else {
            return $this->asJson(false);
        }
    }


    public function actionItemAdd($id)
    {
        return $this->actionAdd($id);
    }

    
    public function actionItemDel($id)
    {
        $model = Cart::findOne(['user_id' => Yii::$app->user->id]);
        $product = Product::findOne($id);
        if ($model && $product) {
            
            $cartItem = CartItem::findOne(['cart_id' => $model->id, 'product_id' => $id]);
            
            $cartItem->amount--;
            $cartItem->cost -= $product->cost;
            if (!$cartItem->save()) {
               VarDumper::dump($cartItem->errors, true, 10); die;
            }

            if ($cartItem->amount == 0) {
                $cartItem->delete();
            }
            
            $model->amount--;
            $model->cost -= $product->cost;
            $model->save();

            return $this->asJson(true);
        }

        return $this->asJson(false);

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
}
