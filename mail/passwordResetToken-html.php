<?php

use yii\helpers\Html;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>

<div class="password-reset">
    <p>Добрый день, <?= Html::encode($user->username) ?>,</p>
    <p>Для восстановления пароля перейдите по ссылки:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>