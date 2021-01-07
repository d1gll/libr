<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $username;
    public $email;
    public $password;
    public $repeat_password;
    public $age;
    public $card;
    public $cvc;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Заполните поле'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Уже существует'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Заполните поле'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Уже существует'],
            [['repeat_password','password'], 'required', 'message' => 'Заполните поле'],
            [['repeat_password','password'], 'string', 'min' => 6],
            ['age', 'integer', 'min' => 1, 'max' => 99],
            ['age', 'trim'],
            [['cvc', 'card', 'age'], 'required', 'message' => 'Заполните поле'],
            [ 'cvc', 'string', 'length' => [3, 3]],
            ['password', 'compare', 'compareAttribute' => 'repeat_password'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'repeat_password' => 'Повторите пароль',
            'age' => 'Ваш возраст (лет)',
            'card' => 'Номер карты',
            'cvc' => 'Секретные три цифры',
        ];
    }


    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $auth = Yii::$app->security->generateRandomString();
        Yii::$app
            ->mailer
            ->compose(
                ['html' => 'letterForAdmin-html', 'text' => 'letterForAdmin-text'],
                ['user' => $this->username, 'auth' =>$auth]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Подтверждение email')
            ->send();

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = User::STATUS_DELETED;
        $user->setPassword($this->password);
        $user->auth_key = $auth;
        $user->age = $this->age;;
        $user->card = $this->card;;
        $user->cvc = $this->cvc;;
        $user->save();

        if ($user)
           {

                $auth = Yii::$app->authManager;
                $editor = $auth->getRole('editor'); // Получаем роль editor
                $auth->assign($editor, $user->id); // Назначаем пользователю, которому принадлежит модель User
                return $user;

           }
        return null;
    }

}