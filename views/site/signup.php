<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="p-x-1 p-y-3">


    <div class="row">
        <div class="col-md-4 col-md-push-4">
            <legend class="m-b-1 text-xs-center"><?= Html::encode($this->title) ?></legend>
            <?php $form = ActiveForm::begin(['id' => 'form-signup',
                'options'=>['class'=>'card card-block m-x-auto bg-faded form-width' ],
            ]); ?>
            <div class="form-group has-float-label">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true,  'class'=>'form-control', 'type'=>'text','placeholder'=>'Имя пользователя']) ?>
            </div>
            <div class="form-group has-float-label">
                <?= $form->field($model, 'email')->textInput(['class'=>'form-control', 'type'=>'email   ','placeholder'=>'Email']) ?>
            </div>
            <div class="form-group has-float-label">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="form-group has-float-label">
                <?= $form->field($model, 'repeat_password')->passwordInput() ?>
            </div>
            <div class="form-group has-float-label">
                <?= $form->field($model, 'age')->textInput(['class'=>'form-control', 'type'=>'number','placeholder'=>'Возраст']) ?>
            </div>
            <div class="form-group has-float-label">
                <?= $form->field($model, 'card')->textInput(['class'=>'form-control', 'id'=>'creditCardText', 'type'=>'text', 'maxlength'=>'19']) ?>
            </div>
            <div class="form-group has-float-label">
                <?= $form->field($model, 'cvc')->textInput(['class'=>'form-control', 'type'=>'number', 'maxlength'=>'3']) ?>
            </div>
            <div class="text-xs-center">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-block btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>