<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\OrderSearch;
use app\models\Status;
use app\models\Payment;
use app\models\Delivery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\CsvForm;
use yii\web\UploadedFile;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
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

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
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
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $statusList = Status::find()->all();
        $paymentList = Payment::find()->all();
        $deliveryList = Delivery::find()->all();

        return $this->render('create', [
            'model' => $model,
            'statusList' => $statusList,
            'paymentList' => $paymentList,
            'deliveryList' => $deliveryList
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $statusList = Status::find()->all();
        $paymentList = Payment::find()->all();
        $deliveryList = Delivery::find()->all();

        return $this->render('update', [
            'model' => $model,
            'statusList' => $statusList,
            'paymentList' => $paymentList,
            'deliveryList' => $deliveryList
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * ImportCsv
     * @return mixed
     */
    public function actionCsv()
    {
        $model = new CsvForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->validate()) {

                if (($handle = fopen($model->file->tempName, 'r')) !== false) {
                    $r = 0;
                    $good = '';
                    $bad = '';
                    
                    while (($row = fgetcsv($handle, 1000, ';')) != FALSE) {
                        $r++;
                        if ($r==1) continue;

                        $order = new Order();

                        if ($status = Status::findOne(['title' => $row[0]]))
                            $order->status_id = $status->id;

                        if ($payment = Payment::findOne(['title' => $row[1]]))
                            $order->payment_id = $payment->id;

                        if ($delivery = Delivery::findOne(['title' => $row[2]]))
                            $order->delivery_id = $delivery->id;

                        $order->cart = $row[3]; 
                        $order->summ = $row[4]; 
                        $order->name = $row[5]; 
                        $order->phone = $row[6]; 

                        if ($order->save()) {
                            $good .= 'Строка №' . $r . ' добавленна! Номер в базе №' . $order->id . '<hr>';
                        } else {  
                            $bad .= 'Строка №' . $r . ' не добавленна! Ошибки:</br>';
                            foreach ($order->getErrors() as $error) {
                                foreach ($error as $text) {
                                    $bad .= '- ' . $text . '</br>';
                                }
                            }
                            $bad .= '<hr>';

                        }
                    }
                }

                if ($good)
                    Yii::$app->session->setFlash('success', $good);
                if ($bad)
                    Yii::$app->session->setFlash('error', $bad);

                return $this->goHome();
            }
        }

        return $this->render('csv', ['model' => $model]);
    }
}
