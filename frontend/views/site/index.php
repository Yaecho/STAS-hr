<?php

use yii\helpers\Html;

$this->title = '南京工业大学大学生科学技术协会';
$this->params['nav'] = '1';
?>
<div class="am-container" style="max-width: 800px;">
    <br>
    <div class="am-panel am-panel-default am-animation-scale-up">
        <div class="am-panel-bd">
            <br>
            <div class="am-text-center">
                <p class="am-text-xl"><a href="<?=$iUrl?>" target="_blank" style="color:#000;">南京工业大学大学生科学技术协会</a></p>
                <p class="am-text-lg">报名表</p>
            </div>
            <form id="resumeForm" action="<?=\yii\helpers\Url::to(['site/index'])?>" method="post" class="am-form">
                <input type="hidden" name="_csrf-frontend" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>"/>
                <div class="am-g">
                    <div class="am-u-md-8">
                        <div class="am-form-group">
                            <h3>1、姓名：</h3>
                            <input type="text" name="ResumeForm[name]" id="name" class="am-form-field" maxlength="25" placeholder="输入真实姓名" data-validation-message="请输入真实姓名" required="">
                        </div>
                        <div class="am-form-group">
                            <h3>2、性别：</h3>
                            <label class="am-radio">
                                <input type="radio" name="ResumeForm[sex]" value="男" data-am-ucheck required> 男
                            </label>
                            <label class="am-radio">
                                <input type="radio" name="ResumeForm[sex]" value="女" data-am-ucheck> 女
                            </label>
                        </div>
                        <div class="am-form-group">
                            <h3>3、学号：</h3>
                            <input type="number" name="ResumeForm[sid]" id="sid" class="am-form-field" placeholder="输入十位学号" data-validation-message="请输入十位学号" pattern="^\d{10}$" required="">
                        </div>
                        <div class="am-form-group">
                            <h3>4、籍贯：</h3>
                            <input type="text" name="ResumeForm[place]" id="place" class="am-form-field" placeholder="输入你的籍贯" minlength="1" maxlength="30" required="">
                        </div>
                        <div class="am-form-group">
                            <h3>5、出生年月：</h3>
                            <div class="am-input-group am-datepicker-date" data-am-datepicker="{format: 'yyyy-mm', viewMode: 'years', minViewMode: 'months'}">
                                <input type="text" class="am-form-field" name="ResumeForm[birthday]" id="birthday" placeholder="输入你的出生年月" readonly required>
                                <span class="am-input-group-btn am-datepicker-add-on">
                                  <button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
                                </span>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <h3>6、政治面貌：</h3>
                            <label class="am-radio">
                                <input type="radio" name="ResumeForm[identity]" value="共青团员" data-am-ucheck required> 共青团员
                            </label>
                            <label class="am-radio">
                                <input type="radio" name="ResumeForm[identity]" value="预备党员" data-am-ucheck> 预备党员
                            </label>
                            <label class="am-radio">
                                <input type="radio" name="ResumeForm[identity]" value="中共党员" data-am-ucheck> 中共党员
                            </label>
                            <label class="am-radio">
                                <input type="radio" name="ResumeForm[identity]" value="群众" data-am-ucheck> 群众
                            </label>
                            <label class="am-radio">
                                <input type="radio" name="ResumeForm[identity]" value="其他" data-am-ucheck> 其他
                            </label>  
                        </div>
                        <div class="am-form-group">
                            <h3>7、学院：</h3>
                            <input type="text" name="ResumeForm[college]" id="college" class="am-form-field" placeholder="输入你的学院" minlength="1" maxlength="30" required="">
                        </div>
                        <div class="am-form-group">
                            <h3>8、专业班级：</h3>
                            <input type="text" name="ResumeForm[class]" id="classVal" class="am-form-field" placeholder="输入你的专业班级" minlength="1" maxlength="30" required="">
                        </div>
                        <div class="am-form-group">
                            <h3>9、宿舍（填写宿舍区即可）：</h3>
                            <input type="text" name="ResumeForm[dorm]" id="dorm" class="am-form-field" placeholder="输入你的宿舍" minlength="1" maxlength="30" required="">
                        </div>
                        <div class="am-form-group">
                            <h3>10、联系方式（非常重要）：</h3>
                            <input type="tel" name="ResumeForm[phone]" id="phone" class="am-form-field" placeholder="输入手机号码" pattern="^1[0-9]{10}$" data-validation-message="请输入正确的手机号码" required="">
                        </div>
                        <div class="am-form-group">
                            <h3>11、QQ（选填）：</h3>
                            <input type="number" name="ResumeForm[qq]" id="qq" class="am-form-field" placeholder="输入你的QQ号">
                        </div>
                    </div>
                    <div class="am-u-md-12">
                        <div class="am-form-group">
                            <h3>12、第一意向：</h3>
                            <?php foreach(Yii::$app->params['department'] as $v):?>
                            <label class="am-radio">
                                <input type="radio" value="<?= Html::encode($v)?>" name="ResumeForm[first_wish]" data-am-ucheck required> <?= Html::encode($v)?>
                            </label>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="am-u-md-12">
                        <div class="am-form-group">
                            <h3>13、第二意向：</h3>
                            <?php foreach(Yii::$app->params['department'] as $v):?>
                                <label class="am-radio">
                                    <input type="radio" value="<?= Html::encode($v)?>" name="ResumeForm[second_wish]" data-am-ucheck required> <?= Html::encode($v)?>
                                </label>
                            <?php endforeach;?>
                            <label class="am-radio">
                                <input type="radio" value="无" name="ResumeForm[second_wish]" data-am-ucheck> 不填
                            </label>
                        </div>
                    </div>
                    <div class="am-u-md-12">
                        <div class="am-form-group">
                            <label>14、兴趣爱好：</label>
                            <textarea name="ResumeForm[hobbies]" id="hobbies"  class="" rows="7" maxlength="535" required=""></textarea>
                        </div>
                        <div class="am-form-group">
                            <label>15、个人简历及自身优势：</label>
                            <textarea name="ResumeForm[myself]" id="myself"  class="" rows="7" maxlength="535" required=""></textarea>
                        </div>
                        <div class="am-form-group">
                            <label>16、希望在科协学到什么，对科协的认识及工作设想：</label>
                            <textarea name="ResumeForm[hope]" id="hope"  class="" rows="7" maxlength="535" required=""></textarea>
                        </div>
                        <p>
                            <a href="javascript:;" id="resumeSubmit" class="am-btn am-btn-primary am-radius">提交</a>
                        </p>
                        <br>
                        <p class="am-text-sm">
                            注: 点击标题“南京工业大学大学生科学技术协会”可以查看南工学生科协及各部门介绍，最终解释权归南京工业大学大学生科学技术协会所有。
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>