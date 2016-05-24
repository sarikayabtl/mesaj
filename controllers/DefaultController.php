<?php

namespace sarikayabtl\mesaj\controllers;

use Yii;
use sarikayabtl\mesaj\models\Mesaj;
use sarikayabtl\mesaj\models\MesajSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use sarikayabtl\mesaj\models\Konusma;

/**
 * DefaultController implements the CRUD actions for Mesaj model.
 */
class DefaultController extends Controller
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
     * Lists all Mesaj models.
     * @return mixed
     */
    public function actionIndex($id = NULL)
    {
       $users = User::find()->all();
	   
       if($id)
       {
       	$model = new Mesaj();
       	$konusma = Konusma::findOne(['konusmaci_1' => yii::$app->user->id,'konusmaci_2' => $id]);
       	if(!$konusma)
       		$konusma = Konusma::findOne(['konusmaci_2' => yii::$app->user->id,'konusmaci_1' => $id]);
       	
       	if(!$konusma)
       	{
       		$konusma = new Konusma();
       		$konusma->konusmaci_1 = yii::$app->user->id;
       		$konusma->konusmaci_2 = $id;
       		$konusma->save();
       		
       	}

       	$post = yii::$app->request->post();
       	if($model->load($post))
       	{
       		$model->konusma_id = $konusma->id;
       		$model->gonderen_id = yii::$app->user->id;
       		date_default_timezone_set("Europe/Istanbul");
        	$model->tarih = date("Y-m-d H:i:s"); 
        	if($model->save())
        		return $this->redirect(['index','id' => $id]);
        	else
        	{
        		print_r($model);
        		exit;
        	}
       	}
       	$kullanici = User::findOne($id);
       	$mesajlar = Mesaj::find()->where(['konusma_id' => $konusma->id])->orderBy(['id' => SORT_ASC])->all();
       	return $this->render('index', [
       			'users' => $users,
       			'mesajlar' => $mesajlar,
       			'kullanici' => $kullanici,
       			'model' => $model,
       			]);
       }else 
       {
       	return $this->render('index', [
       			'users' => $users,
       			]);
       }

       
    }

    /**
     * Displays a single Mesaj model.
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
     * Creates a new Mesaj model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mesaj();
        
        $alicilar = User::find()->all();
        
		
        if ($model->load(Yii::$app->request->post())) {
        	
        	date_default_timezone_set("Europe/Istanbul");
        	$model->tarih = date("Y-m-d H:i:s");
        	if( $model->save())
            	return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'alicilar' => $alicilar,
            ]);
        }
    }

    /**
     * Updates an existing Mesaj model.
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
     * Deletes an existing Mesaj model.
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
     * Finds the Mesaj model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mesaj the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mesaj::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
