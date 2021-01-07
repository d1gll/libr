<?php
use app\models\User;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>

    Доюрый день, <?= $user->username ?>,
    Для восстановления пароля перейдите по ссылки:

<?= $resetLink ?>