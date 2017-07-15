<?php

namespace app\controllers;

use Yii;
use app\models\Acdetail;
use app\models\AcdetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;

/**
 * AcdetailController implements the CRUD actions for Acdetail model.
 */
class AcdetailController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Acdetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AcdetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Acdetail model.
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
     * Creates a new Acdetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Acdetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Acdetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionUpdatedetail($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/acmain/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionUpdatecus($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/customers/index']);
        } else {
            return $this->render('updatecus', [
                'model' => $model,
            ]);
        }
    }
    public function actionUpdateindex2($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/acdetail/get-customer','customer_id'=>$model->customer_id]);
        } else {
            return $this->renderAjax('updateindex2', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Acdetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Acdetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

    public function actionGetCustomer($customer_id){
    $sql="SELECT * from acdetail de 
            WHERE de.customer_id='$customer_id'
            and de.arrear < 0";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([            
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('index2',[
            'dataProvider'=>$dataProvider,
            'sql'=>$sql,
            'rawData'=>$rawData,
            'customer_id'=>$customer_id
            
        ]);
    }
    public function actionArrear($customer_id){
         $arr = Acdetail::find()
                 ->where(['customer_id'=>$customer_id])
                 ->sum('arrear');
         
        
    }
}
