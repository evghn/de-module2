<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Role;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'Вы успешно вошли в систему!');
            return Yii::$app->user->identity->isAdmin
                ? $this->redirect('/admin')
                : $this->redirect('/account')                
                ;
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        Yii::$app->session->setFlash('info', 'Вы успешно вышли из системы');
        return $this->goHome();
    }

    
    // метод регистрации пользователя
    public function actionRegister()
    {
        $user = new \app\models\User();
        if ($user->load(Yii::$app->request->post())) {
            $user->role_id = Role::getRoleId('user');
            $user->auth_key = Yii::$app->security->generateRandomString();
            if ($user->validate()) {
                $user->password = Yii::$app->security->generatePasswordHash($user->password);
                if ($user->save()) {
                    Yii::$app->session->setFlash('success', 'Пользователь зарегистрирован!');
                    Yii::$app->user->login($user);
                    return $this->redirect('/account');
                }

            } else {
                Yii::debug($user->errors);

            }
        }
        return $this->render('register', ['model' => $user,]);
    }
}
