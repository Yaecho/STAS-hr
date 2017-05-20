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
    <title>南工学生科协-<?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .accordion {
            width: 100%;
            margin: 0px auto 20px;
            background: #ffffff;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
            border: 1px solid #ddd;
        }

        .accordion .link {
            cursor: pointer;
            display: block;
            padding: 15px 15px 15px 42px;
            color: #4D4D4D;
            font-size: 14px;
            font-weight: 700;
            border-bottom: 1px solid #CCC;
            position: relative;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .accordion li:last-child .link {
            border-bottom: 0;
        }

        .accordion li i {
            position: absolute;
            top: 16px;
            left: 12px;
            font-size: 18px;
            color: #595959;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .accordion li i.fa-chevron-down {
            right: 12px;
            left: auto;
            font-size: 16px;
        }

        .accordion li.open .link {
            color: #b63b4d;
        }

        .accordion li.open i {
            color: #b63b4d;
        }
        .accordion li.open i.fa-chevron-down {
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            -o-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        /**
        * Submenu
        -----------------------------*/
        .submenu {
            display: none;
            background: #e9e7ef;
            font-size: 14px;
        }

        .submenu li {
            border-bottom: 1px solid #ddd;
        }

        .submenu a {
            display: block;
            text-decoration: none;
            color: #392f41;
            padding: 12px;
            padding-left: 42px;
            -webkit-transition: all 0.25s ease;
            -o-transition: all 0.25s ease;
            transition: all 0.25s ease;
        }

        .submenu a:hover {
            background: #057748;
            color: #FFF;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '南工学生科协',
        'brandUrl' => \yii\helpers\Url::to(['space/index']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top navbar',
        ],
    ]);
    $menuItems = [
        ['label' => '用户中心', 'url' => ['/space/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        $menuItems[] =
        [
            'label' => '退出(' . Yii::$app->user->identity->truename . ')',
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
            'homeLink' => [
                'label' => '首页',
                'url' => ['space/index'],
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?php if (Yii::$app->user->isGuest) :?>
            <?= $content ?>
        <?php else:?>
        <div class="row">
            <div class="col-md-3">
                <ul id="accordion" class="accordion">
                    <li>
                        <div class="link"><i class="fa fa-info-circle"></i>个人中心<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu">
                            <li><a href="<?=Url::to(['space/index'])?>">个人中心</a></li>
                            <li><a href="#">HTML</a></li>
                            <li><a href="<?=Url::to(['guide/index'])?>" target="_blank">签到人员入口</a></li>
                            <li><a href="<?=Url::to(['interviewer/index'])?>" target="_blank">面试人员入口</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="link"><i class="fa fa-address-card-o"></i>简历中心<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu">
                            <li><a href="<?=Url::to(['resume/index'])?>">简历管理</a></li>
                            <li><a href="<?=Url::to(['repeat-resume/index'])?>">重复简历筛选</a></li>
                            <li><a href="<?=Url::to(['recycle/recycle'])?>">简历回收站</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="link"><i class="fa fa-database"></i>数据管理<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu">
                            <li><a href="<?=Url::to(['import-and-export/index'])?>">导入导出</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="link"><i class="fa fa-send"></i>短信管理<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu">
                            <li><a href="<?=Url::to(['sms/index'])?>">短信发送</a></li>
                            <li><a href="<?=Url::to(['sms/phone-number'])?>">手动发送</a></li>
                        </ul>
                    </li>
                    <li><div class="link"><i class="fa fa-group"></i>用户面板<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu">
                            <li><a href="<?=Url::to(['user/index'])?>">用户管理</a></li>
                            <li><a href="<?=Url::to(['auth/index'])?>">角色管理</a></li>
                            <li><a href="<?=Url::to(['rule/index'])?>">规则管理</a></li>
                            <li><a href="<?=Url::to(['user-role/index'])?>">用户授权</a></li>
                        </ul>
                    </li>
                    <li><div class="link"><i class="fa fa-sliders"></i>系统设置<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu">
                            <li><a href="<?=Url::to(['room-assignment/index'])?>">面试教室</a></li>
                            <li><a href="<?=Url::to(['user/index'])?>">报名时间</a></li>
                            <li><a href="<?=Url::to(['auth/index'])?>">短信确认设置</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <?= $content ?>
            </div>
        </div>
        <?php endif;?>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; 南工学生科协 <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<script>
    $(function() {
        var Accordion = function(el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;

            // Variables privadas
            var links = this.el.find('.link');
            // Evento
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
        }

        Accordion.prototype.dropdown = function(e) {
            var $el = e.data.el;
                $this = $(this),
                $next = $this.next();

            $next.slideToggle();
            $this.parent().toggleClass('open');

            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            };
        }	

        var accordion = new Accordion($('#accordion'), false);
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
