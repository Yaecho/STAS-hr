<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => $this->title,
        'brandUrl' => \yii\helpers\Url::to(['space/index']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top navbar',
        ],
    ]);
    $menuItems = [
        ['label' => '主页', 'url' => ['/space/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        $menuItems[] =
        [
            'label' => '退出(' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post'],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="<?=Url::to(['user/index'])?>" class="list-group-item active">
                        用户管理
                    </a>
                    <a href="<?=Url::to(['resume/index'])?>" class="list-group-item">简历管理</a>
                    <a href="#" class="list-group-item">简历回收站</a>
                    <a href="#" class="list-group-item">个人信息</a>
                    <a href="#" class="list-group-item">...管理</a>
                </div>
            </div>
            <div class="col-md-9">
                <?= $content ?>
            </div>
        </div>

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
