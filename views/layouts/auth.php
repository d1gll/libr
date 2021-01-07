<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\YiiAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
NavBar::begin([ 'options' => ['class' => 'navbar-inverse']]);
$menuItems = [
    ['label' => 'Регистрация', 'url' => ['/site/signup']],
    ['label' => 'Авторизация', 'url' => ['/site/login']],

];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav col-md-5 col-md-push-5'],
    'items' => $menuItems,
]);
NavBar::end();
?>
<br>
<div class="container">

    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>