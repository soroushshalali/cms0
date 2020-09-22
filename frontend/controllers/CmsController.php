<?php

namespace frontend\controllers;
use common\models\LoginForm;
use frontend\models\Articles;
use frontend\models\SignupForm;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;

class CmsController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['insert'],
                'rules' => [
                    [
                        'actions' => ['insert'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $tenDays=time()-864000;
        $condition='created_at > '. $tenDays;
        $articles=Articles::find()->where($condition)->all();
        return $this->render('index' ,['articles'=> $articles]);
    }

    public function actionArticle($id = null){
        if ($id !== null){
            $model=Articles::findOne($id);
        if ($model !== null){
            return $this->render('article', [
                'model' => $model ,
            ]);
        }

        }
    }

    public function actionArticles(){
        $articles= Articles::find()->all();
        return $this->render('articles', [
            'articles' => $articles ,
        ]);
    }

    public function actionSignup(){
        $model=new SignupForm();
        if($model->load(Yii::$app->request->post()) && $model->signup()){
            $model->login();
            return $this->goHome();
        }
         return $this->render('signup' , ['model' => $model]);
    }

    public function actionLogin()
    {

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {

            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAbout(){
        return $this->render('about');
    }

    public function actionSearch($value=null)
    {
        if (isset($value)){
            $art=new Articles();
            $query='SELECT * FROM `articles` WHERE text like "%'.$value.'%"';
            $result=$art::findBySql($query,[':text'=>'asd'])->all();
            return $this->render('search_result' , ['result' => $result]);
        }else{
           return $this->goBack();
        }

    }

    public function actionInsert(){
        $model=new Articles();
        $model->author_id=13;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

//        $model->author_id=Yii::$app->user->id;

        return $this->render('insert' , ['model' => $model] );
    }

}
