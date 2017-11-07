


<?php $form=\yii\bootstrap\ActiveForm::begin()?>

<?=$form->field($model,'name')->textInput() ?>
<?=$form->field($model,'intro')->textInput() ?>
<?=\yii\bootstrap\Html::img('@web/'.$model->logo,['height'=>50]) ?>
<?=$form->field($model,'sort')->textInput() ?>
<?=$form->field($model,'status')->radioList(\backend\models\Brand::$statusText) ?>


<?php
// ActiveForm
echo $form->field($model, 'logo')->widget('manks\FileInput', []);

?>



<?=\yii\helpers\Html::submitButton('提交',['class'=>'btn btn-success'])?>



<?php $form=\yii\bootstrap\ActiveForm::end()?>
