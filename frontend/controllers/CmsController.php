<?php
namespace frontend\controllers;

use common\component\AuthorRule;
use common\models\LoginForm;
use common\models\User;
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
                'only' => ['insert' , 'delete' , 'update'],
                'rules' => [
                    [
                        'actions' => ['insert' , 'delete' , 'update'],
                        'allow' => true,
                        'roles' => ['user'],
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
        $user = User::findOne(Yii::$app->user->id);
        $model=new Articles();
        $model->author_id=Yii::$app->user->id;
        $model->author=$user->username;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('insert' , ['model' => $model] );
    }

    public function actionDelete($id=null){
        if (isset($id)){
            $article= Articles::find($id)->one();
             if ($article !== null){
                $article->delete();
                $this->goBack();
             }
        }
    }

    public function actionUpdate($id=null){
        if (isset($id)){
            $model= Articles::find($id)->one();
        }else{
            echo 'id:(';
        }
       
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update' , ['model' => $model] );
    }

    public function actionProfile(){
        $user = User::findOne(Yii::$app->user->id);
        return $this->render('profile' , ['user' => $user]);
    }

    public function actionInit(){
        $auth=Yii::$app->authManager;

        $insert=$auth->createPermission('insert');
        $auth->add($insert);

        $delete=$auth->createPermission('delete');
        $auth->add($delete);

        $update=$auth->createPermission('update');
        $auth->add($update);

        $admin=$auth->createRole('admin');
        $auth->add($admin);

        $user=$auth->createRole('user');
        $auth->add($user);

        $auth->addChild($admin , $delete);
        $auth->addChild($admin , $update);
        $auth->addChild($admin , $insert);

        $auth->addChild($user , $delete);
        $auth->addChild($user , $update);
        $auth->addChild($user , $insert);


        $auth->assign($admin , 1);


        //Rule
        $rule=new AuthorRule();
        $auth->add($rule);

        $deleteOwnPost=$auth->createPermission('deleteOwnPost');
        $deleteOwnPost->ruleName= $rule->name;
        $auth->add($deleteOwnPost);
        $auth->addChild($deleteOwnPost , $delete);
        $auth->addChild($user,$deleteOwnPost);




    }

}
