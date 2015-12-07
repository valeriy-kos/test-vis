<?php
namespace frontend\controllers;

use app\models\Firms;
use app\models\GuestBook;
use app\models\Phones;
use common\models\LoginForm;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
     * @return mixed
     */
    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => Firms::find(),
        ]);
        $dataProviderPhones = new ActiveDataProvider([
            'query' => Phones::find(),
        ]);
        $sql = "SELECT id, Name, p.Phone as pPhone FROM ".Firms::tableName().
            " LEFT JOIN  ".Phones::tableName(). " as p ON id = p.FirmID ".
        " GROUP BY id";
        $query = Firms::findBySql($sql);
        $dataProvider1 = new ActiveDataProvider([
            'query' => $query,
        ]);
        $sql = "SELECT id, Name, p.Phone as pPhone FROM ".Firms::tableName().
            " LEFT JOIN  ".Phones::tableName(). " as p ON id = p.FirmID ".
            " GROUP BY id HAVING count(p.phone_id) = '0'";
        $query = Firms::findBySql($sql);
        $dataProvider2 = new ActiveDataProvider([
            'query' => $query,
        ]);
        $sql = "SELECT id, Name, p.Phone as pPhone FROM ".Firms::tableName().
            " LEFT JOIN  ".Phones::tableName(). " as p ON id = p.FirmID ".
            " GROUP BY id HAVING count(p.phone_id) >= '2'";
        $query = Firms::findBySql($sql);
        $dataProvider3 = new ActiveDataProvider([
            'query' => $query,
        ]);
        $sql = "SELECT id, Name, p.Phone as pPhone FROM ".Firms::tableName().
            " LEFT JOIN  ".Phones::tableName(). " as p ON id = p.FirmID ".
            " GROUP BY id HAVING count(p.phone_id) < '2'";
        $query = Firms::findBySql($sql);
        $dataProvider4 = new ActiveDataProvider([
            'query' => $query,
        ]);
        $sql = "SELECT id, Name, p.Phone as pPhone FROM ".Firms::tableName().
            " LEFT JOIN  ".Phones::tableName(). " as p ON id = p.FirmID ".
            " GROUP BY id HAVING count(p.phone_id) = (SELECT MAX( cpid) AS mcpid
                    FROM (
                    SELECT count(FirmID) AS cpid
                    FROM ".Firms::tableName()."
                    LEFT JOIN ".Phones::tableName()." ON id = FirmID
                    GROUP BY FirmID
                    ) AS cphone)";
        $query = Firms::findBySql($sql);
        $dataProvider5 = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('index',
            ['dataProvider'=>$dataProvider,
                'dataProviderPhones'=>$dataProviderPhones,
            'dataProvider1'=>$dataProvider1,'dataProvider2'=>$dataProvider2,
                'dataProvider3'=>$dataProvider3,'dataProvider4'=>$dataProvider4,'dataProvider5'=>$dataProvider5]);
    }

    public function actionGuestBook(){
        $model = new GuestBook();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->session->get('guestbook') == 'Verification') {
            Yii::$app->session->set('guestbook','success');
            Yii::$app->session->setFlash('success', 'Сообщение добавлено в гостевую книгу.');
            $model->created_at=date("Y-m-d H:i:s");
            $model->save(false);
            return $this->redirect(['guest-book']);
        }

        $allItems=GuestBook::find()->where('on_off=0')->orderBy('created_at DESC')->all();

        return $this->render('guestbook',['model'=>$model,
            'allItems'=>$allItems]);
    }

    public function actionValidGuestBook(){
        $model = new GuestBook();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $message = ActiveForm::validate($model);
            if(empty($message)){
                Yii::$app->session->set('guestbook','Verification');
            }else{
                Yii::$app->session->set('guestbook','error');
            }
            return $message;
        }else{
            return '';
        }

    }

    public function actionDateInFuture(){
        return $this->render('dateinfuture');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
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
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
