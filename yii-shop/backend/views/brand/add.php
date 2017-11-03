


<?php $form=\yii\bootstrap\ActiveForm::begin()?>

<?=$form->field($model,'name')->textInput() ?>
<?=$form->field($model,'intro')->textInput() ?>
<?=$form->field($model,'imgFile')->fileInput() ?>
<?=$form->field($model,'sort')->textInput() ?>
<?=$form->field($model,'status')->radioList(\backend\models\Brand::$statusText) ?>




<?=\yii\helpers\Html::submitButton('提交',['class'=>'btn btn-success'])?>



<?php $form=\yii\bootstrap\ActiveForm::end()?>
