<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="p-x-1 p-y-3">


    <div class="row">
        <div class="col-md-4 col-md-push-4">
            <legend class="m-b-1 text-xs-center"><?= Html::encode($this->title) ?></legend>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options'=>['class'=>'card card-block m-x-auto bg-faded form-width' ],
            ]); ?>
            <div class="form-group has-float-label">
                <?= $form->field($model, 'username')->textInput(['autocomplete' => 'off', 'class'=>'form-control', 'type'=>'text','placeholder'=>'Имя пользователя']) ?>
            </div>
            <div class="form-group has-float-label">
                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'********']) ?>
            </div>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                <?= Html::a('Забыли пароль?', ['site/request-password-reset']) ?>
            </div>

            <div class="text-xs-center">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-block btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>