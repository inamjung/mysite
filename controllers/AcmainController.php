<?php

namespace app\controllers;

use Yii;
use app\models\Acmain;
use app\models\AcmainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Acdetail;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use kartik\widgets\DepDrop;

/**
 * AcmainController implements the CRUD actions for Acmain model.
 */
class AcmainController extends Controller
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
     * Lists all Acmain models.
     * @return mixed
     */
    public function actionIndexmain()
    {
        $searchModel = new AcmainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexmain', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
public function actionIndex() {
        $searchModel = new AcmainSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Acmain::find()->orderBy('id desc'),
        ]);
        

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }
    /**
     * Displays a single Acmain model.
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
     * Creates a new Acmain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Acmain();
        $modelDetails = [];

        $formDetails = Yii::$app->request->post('Acdetail', []);
        foreach ($formDetails as $i => $formDetail) {
            $modelDetail = new Acdetail(['scenario' => Acdetail::SCENARIO_BATCH_UPDATE]);
            $modelDetail->setAttributes($formDetail);
            $modelDetails[] = $modelDetail;
        }

        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRow') == 'true') {
            $model->load(Yii::$app->request->post());
            $modelDetails[] = new Acdetail(['scenario' => Acdetail::SCENARIO_BATCH_UPDATE]);
            return $this->render('create', [
                        'model' => $model,
                        'modelDetails' => $modelDetails
            ]);
        }

        if ($model->load(Yii::$app->request->post())) {            
            if (Model::validateMultiple($modelDetails) && $model->validate()) {
                $model->user_id = \Yii::$app->user->identity->id;
                $model->create_at = date('Y-m-d');                
                $model->save();
                
                foreach ($modelDetails as $modelDetail) {                    
                     
                    $modelDetail->arrear = $modelDetail->pay - $modelDetail->amount;
                    
//                    if($modelDetail->pay - $modelDetail->amount < 0){
//                        $modelDetail->arrear = 0;
//                    }  else {
//                        $modelDetail->arrear = 1;
//                    }
                    //$modelDetail->remark = $arr + $modelDetail->amount;
                    $modelDetail->acmain_id = $model->id;
                    $modelDetail->save();
                }
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'modelDetails' => $modelDetails
        ]);
    }
    
    /**
     * Updates an existing Receipt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelDetails = $model->detail;

        $formDetails = Yii::$app->request->post('Acdetail', []);
        foreach ($formDetails as $i => $formDetail) {
            //loading the models if they are not new
            if (isset($formDetail['id']) && isset($formDetail['updateType']) && 
                    $formDetail['updateType'] != Acdetail::UPDATE_TYPE_CREATE) {
                //making sure that it is actually a child of the main model
                $modelDetail = Acdetail::findOne(['id' => $formDetail['id'],
                    'acmain_id' => $model->id]);
                $modelDetail->setScenario(Acdetail::SCENARIO_BATCH_UPDATE);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[$i] = $modelDetail;
                //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
            } else {
                $modelDetail = new Acdetail(['scenario' => Acdetail::SCENARIO_BATCH_UPDATE]);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[] = $modelDetail;
            }
        }

        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRow') == 'true') {
            $modelDetails[] = new Acdetail(['scenario' => Acdetail::SCENARIO_BATCH_UPDATE]);
            return $this->render('update', [
                        'model' => $model,
                        'modelDetails' => $modelDetails
            ]);
        }

        if ($model->load(Yii::$app->request->post())) {
            if (Model::validateMultiple($modelDetails) && $model->validate()) {
                $model->save();
                foreach ($modelDetails as $modelDetail) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail->updateType == Acdetail::UPDATE_TYPE_DELETE) {
                        $modelDetail->delete();
                    } else {
                        //new or updated records go here
                        $modelDetail->arrear = $modelDetail->pay - $modelDetail->amount;
                        $modelDetail->acmain_id = $model->id;
                        $modelDetail->save();
                    }
                }
                return $this->redirect(['acmain/index']);
            }
        }


        return $this->render('updateform', [
                    'model' => $model,
                    'modelDetails' => $modelDetails
        ]);
    }

    /**
     * Deletes an existing Acmain model.
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
     * Finds the Acmain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Acmain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Acmain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSumbyac($date1=null,$date2=null){
        
        
      $sql="SELECT am.ac_date,SUM(de.amount) amount,SUM(de.pay) pay 
            ,if (SUM(de.pay)-SUM(de.amount) < 0 ,SUM(de.pay)-SUM(de.amount),0) as total

            FROM acdetail de
            LEFT JOIN acmain am on am.id=de.acmain_id
            where am.ac_date BETWEEN '$date1' and '$date2'
            GROUP BY de.acmain_id ORDER BY am.id desc";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([            
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('sumbyac',[
            'dataProvider'=>$dataProvider,
            'sql'=>$sql,
            'rawData'=>$rawData,
            'date1'=>$date1,
            'date2'=>$date2
        ]);
    }
    public function actionCusarrear(){
        
        $sql ="SELECT c.*,SUM(ad.arrear) cusarrear
                FROM acdetail ad 
                LEFT JOIN customers c on c.id=ad.customer_id
                GROUP BY c.id";
        try {
            $rawData =  \yii::$app->db->createCommand($sql)->queryAll();
        }catch(yii\db\Exception $e){
            throw new yii\web\ConflictHttpException('sql error');
        } 
       
         $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' =>$rawData,
            
        ]);        
        return $this->render('cusarrear',[
            'dataProvider'=>$dataProvider,
            'rawData'=>$rawData,
            'sql'=>$sql            
        ]);
        
    }
        
}
