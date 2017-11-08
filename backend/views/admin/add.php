


<?php $form=\yii\bootstrap\ActiveForm::begin()?>

<?=$form->field($model,'username')->textInput() ?>
<?=$form->field($model,'password')->passwordInput() ?>
<?=$form->field($model,'email')->textInput() ?>


<?=\yii\helpers\Html::submitButton('提交',['class'=>'btn btn-success'])?>

<?php $form=\yii\bootstrap\ActiveForm::end()?>
