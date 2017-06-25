<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport"
              content="width=device-width, initial-scale=1">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="stylesheet" href="statics/AmazeUI-2.7.2/css/amazeui.min.css">
        <link rel="stylesheet" href="statics/AmazeUI-2.7.2/css/app.css">
        <style type="text/css">
            html,body{background: #f0f0f4;}
            .am-footer{background: #f0f0f4;}
        </style>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <header class="am-topbar am-topbar-fixed-top">
        <h1 class="am-topbar-brand">
            <a href="<?=Yii::$app->homeUrl ?>"><?= Html::encode($this->title) ?></a>
        </h1>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right">
                <li <?php if ($this->params['nav'] == '1'){echo 'class="am-active"';}?>><a href="<?=Yii::$app->homeUrl ?>">报名表</a></li>
                <li <?php if ($this->params['nav'] == '2'){echo 'class="am-active"';}?>><a href="<?=\yii\helpers\Url::to(['site/sms-res']) ?>">短信确认</a></li>
            </ul>

        </div>
    </header>

    <?= $content ?>

    <footer class="am-footer am-footer-default">
        <br>
        <div class="am-footer-miscs">
            <p>CopyRight©<?= date('Y')?> 南京工业大学大学生科学技术协会.</p>
            <p>由 <a href="http://www.yiiframework.com/" rel="external" target="_blank">Yii框架</a> 强力驱动</p>
        </div>
    </footer>
    <div class="am-modal am-modal-alert" tabindex="-1" id="webInfo">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">系统信息</div>
            <div class="am-modal-bd" id="webInfoBd">
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" id="webInfoConfirm">确定</span>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
    <!--[if (gte IE 9)|!(IE)]><!-->
    <!--<script src="statics/AmazeUI-2.7.2/js/jquery-3.2.1.min.js"></script>-->
    <!--<![endif]-->
    <!--[if lte IE 8 ]>
    <script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="assets/js/amazeui.ie8polyfill.min.js"></script>
    <![endif]-->
    <script src="statics/AmazeUI-2.7.2/js/amazeui.min.js"></script>
    <script>
        <?php if ($this->params['nav'] == '1'):?>
        $(function() {
            store = $.AMUI.store;

            if (!store.enabled) {
                alert('你的浏览器不支持本地存储，请更换浏览器或设备！');
                return;
            }

            if (store.get('resumeData') !== undefined) {
                var data = store.get('resumeData');
                for(var i in data){
                    if (data.hasOwnProperty(i)) {
                        if (i !== 'ResumeForm[second_wish]' && i !== 'ResumeForm[first_wish]' && i !== 'ResumeForm[sex]' && i !== 'ResumeForm[identity]') {
                            $('#resumeForm input[name="'+ i +'"],#resumeForm textarea[name="'+ i +'"]').val(data[i]);
                        } else {
                            $('#resumeForm input[type=radio][name="'+i+'"][value="'+ data[i] +'"]').attr("checked","checked");
                        }
                    }
                }
            }

            $("#resumeForm input,#resumeForm textarea").change(function(){
                var data = {};
                var cache = store.get('resumeData');
                if ( cache !== undefined){
                    data = cache;
                }

                data[$(this).attr('name')] = $(this).val();

                store.set('resumeData', data);
            });

            var resumeForm = $('#resumeForm');

            resumeForm.validator({
                onValid: function(validity) {
                    $(validity.field).closest('.am-form-group').find('.am-alert').hide();
                },

                onInValid: function(validity) {
                    var $field = $(validity.field);
                    var $group = $field.closest('.am-form-group');
                    var $alert = $group.find('.am-alert');

                    var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

                    if (!$alert.length) {
                        $alert = $('<div class="am-alert am-alert-danger"></div>').hide().
                        appendTo($group);
                    }

                    $alert.html(msg).show();
                }
            });

            $("#resumeSubmit").click(function(){
                if(resumeForm.validator('isFormValid')){
                    $('#resumeSubmit').addClass('am-disabled');
                    $.post( "<?=\yii\helpers\Url::to(['site/index'])?>", $( "#resumeForm" ).serialize(), function( data ) {
                        var res = $.parseJSON(data);
                        if (res.code === '1'){
                            $('#webInfoBd').html(res.msg);
                            $('#webInfo').modal();
                            $("#resumeForm input,#resumeForm textarea").val('');
                            $('input:radio:checked').attr("checked",false);
                            resumeForm.validator('destroy');
                            store.clear();
                            $('#webInfoConfirm').click(function(){
                                location.reload();
                            });
                        } else {
                            $('#webInfoBd').html(res.msg);
                            $('#webInfo').modal();
                        }
                        $('#resumeSubmit').removeClass('am-disabled');
                    });
                }
            });
        });
        <?php endif;?>
        <?php if ($this->params['nav'] == '2'):?>
        $(function () {
            var smsResForm = $('#smsResForm');
            $('#smsResSubmit').click(function(){
                if(smsResForm.validator('isFormValid')){
                    $('#smsResSubmit').attr('disabled','disabled');
                    $.post( "<?=\yii\helpers\Url::to(['site/sms-res'])?>", smsResForm.serialize(), function( data ) {
                        var res = $.parseJSON(data);
                        if (res.code === '1'){
                            $('#webInfoBd').html(res.msg);
                            $('#webInfo').modal();
                            $("#code").val('');
                            smsResForm.validator('destroy');
                        } else {
                            $('#webInfoBd').html(res.msg);
                            $('#webInfo').modal();
                        }
                        $('#smsResSubmit').attr('disabled',false);
                    });
                }
            });
        });
        <?php endif;?>
    </script>
    </body>
    </html>

<?php $this->endPage() ?>