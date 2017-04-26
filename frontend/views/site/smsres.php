<?php

//use yii\helpers\Html;

$this->title = '南京工业大学大学生科学技术协会';
$this->params['nav'] = '2';
?>
<div class="am-container" style="max-width: 700px;">
    <br>
    <div class="am-panel am-panel-default am-animation-scale-up">
        <div class="am-panel-bd">
            <br>
            <div class="am-text-center">
                <p class="am-text-lg">短信确认页</p>
                <div class="am-g">

                    <div class="am-u-md-6 am-u-sm-centered">
                        <form action="<?=\yii\helpers\Url::to(['site/sms-res'])?>" method="post" class="am-form" id="smsResForm" data-am-validator>
                            <input type="hidden" name="_csrf-frontend" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>"/>
                            <div class="am-input-group">
                                <input type="number" class="am-form-field" name="ResumeForm[code]" id="code" placeholder="短信确认码" required="">
                                <span class="am-input-group-btn">
                                    <button class="am-btn am-btn-default" type="button" id="smsResSubmit">提交</button>
                                </span>
                            </div>
                        </form>
                        <p>注：简历提交，我们会通过短信发送面试时间和地点，同时包含短信确认码，请及时在本页面填写短信确认码并提交，我们可以统计短信到达情况。</p>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>