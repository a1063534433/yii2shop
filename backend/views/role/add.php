


<?php $form=\yii\bootstrap\ActiveForm::begin()?>

<?=$form->field($model,'name')->textInput() ?>
<?=$form->field($model,'description')->textarea() ?>
<?=$form->field($model,'permission')->checkboxList($permission) ?>

<?=\yii\helpers\Html::submitButton('提交',['class'=>'btn btn-success'])?>

<?php $form=\yii\bootstrap\ActiveForm::end()?>
