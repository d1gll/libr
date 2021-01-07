<?php

use yii\helpers\Html;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/access-user', 'token' => $auth]);
?>

<div class="password-reset">
    <p>Добрый день!</p>
    <p>Новый пользователь: <?= Html::encode($user) ?></p>
    <p>Для подтверждения перейдите по ссылки: <?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>