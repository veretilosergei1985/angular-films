<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="yii2AngApp">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body ng-controller="index">
<?php $this->beginBody() ?>

<div class="wrap">
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#/">Одностраничное приложение</a>
        </div>      
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#/"><i class="glyphicon glyphicon-home"></i> Главная</a></li>
            <li><a href="#/site/about"><i class="glyphicon glyphicon-tag"></i> О приложении</a></li>
            <li><a href="#/site/contact"><i class="glyphicon glyphicon-envelope"></i> Обратная связь</a></li>
        </ul>
    </div>
</nav>
<div id="main" class="container"> 
    <!-- Здесь будет динамическое содержимое -->
    <div ng-view></div>    
</div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
