


<?php $form=\yii\bootstrap\ActiveForm::begin()?>

<?=$form->field($model,'item_name')->textInput() ?>
<?=$form->field($model,'user_id')->textarea() ?>
<?=$form->field($model,'created_at')->checkboxList($permission) ?>

<?=\yii\helpers\Html::submitButton('提交',['class'=>'btn btn-success'])?>

<?php $form=\yii\bootstrap\ActiveForm::end()?>
