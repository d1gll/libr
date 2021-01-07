<?php

namespace app\controllers;

use app\models\AccessUser;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\base\InvalidParamException;

class SiteController extends Controller
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

//    public function beforeAction($action)
//    {
//        if (parent::beforeAction($action)) {
//            if (!\Yii::$app->user->can($action->id)) {
//                throw new ForbiddenHttpException('Access denied');
//            }
//            return true;
//        } else {
//            return false;
//        }
//    }

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

    public function actionAdmin()
    {
        if (!\Yii::$app->user->can('editor'))
        {
            throw new ForbiddenHttpException('Нет такой страницы');
        }
        else {

            $model = User::findByUser();

            return $this->render('admin', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'auth.php';

        if (\Yii::$app->user->can('updateNews'))
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
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

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */

    public function actionSignup()
    {
        $this->layout = 'auth.php';
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    Yii::$app->session->setFlash('success', 'Проверьте свою почту. Мы выслали на нее письмо с подтверждением.');
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте вашу почту');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Мы не смогли отправить сообщение вам на почту.   ');
            }
        }

        return $this->render('PasswordResetRequestForm', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен');
            return $this->goHome();
        }

        return $this->render('resetPasswordForm', [
            'model' => $model,
        ]);
      }

    public function actionAccessUser()
    {
        $request = Yii::$app->request;
        $token = $request->get('token');
        $model = new AccessUser();
        if ($model->resetStatus($token)) {
            Yii::$app->session->setFlash('success', 'Добавлен новый пользователь');
            return $this->goHome();
        }
        Yii::$app->session->setFlash('error', 'Ошибка');
        return $this->render('AccessUserForm', [
            'model' => $model,
        ]);
    }



}
