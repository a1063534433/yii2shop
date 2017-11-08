<a href="<?php echo \yii\helpers\Url::to(['admin/add'])?>" class="btn btn-primary btn-lg active" role="button">注册</a>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
   点击登录
</button>

<!-- Modal -->
<form action="login" method="post">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">用户登录</h4>
            </div>
            <?php $form=\yii\bootstrap\ActiveForm::begin()?>
            <?=$form->field($model,'username')->textInput() ?>
            <?=$form->field($model,'password')->passwordInput() ?>
            <?=\yii\helpers\Html::submitButton('提交',['class'=>'btn btn-success'])?>
            <?php $form=\yii\bootstrap\ActiveForm::end()?>

        </div>
    </div>
</div>
</form>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>用户密码</th>
        <th>盐</th>
        <th>邮箱</th>
        <th>自动登录令牌</th>
        <th>令牌创建时间</th>
        <th>注册时间</th>
        <th>最后登录时间</th>
        <th>IP</th>
        <th>操作</th>
    </tr>
</table>
