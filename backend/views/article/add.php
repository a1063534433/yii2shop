


<?php $form=\yii\bootstrap\ActiveForm::begin()?>

<?=$form->field($model,'name')->textInput() ?>
<?=$form->field($model,'classify_id')->dropDownList(\yii\helpers\ArrayHelper::map($class,'id', 'name'), ['class' => 'dropdownlist']); ?>


<?=$form->field($model,'intro')->textInput() ?>
<?=$form->field($model,'content')->textInput() ?>
<?=$form->field($model,'status')->radioList(\backend\models\Classify::$statusText) ?>
<?=$form->field($model,'sort')->textInput() ?>





<?=\yii\helpers\Html::submitButton('提交',['class'=>'btn btn-success'])?>



<?php $form=\yii\bootstrap\ActiveForm::end()?>
