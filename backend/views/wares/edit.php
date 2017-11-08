


<?php $form=\yii\bootstrap\ActiveForm::begin()?>

<?=$form->field($model,'name')->textInput() ?>
<?=$form->field($model,'sn')->textInput() ?>
<?=$form->field($model,'wares_category_id')->dropDownList(\yii\helpers\ArrayHelper::map($good,'id', 'name'), ['class' => 'dropdownlist']); ?>
<?=\yii\bootstrap\Html::img('@web/'.$model->logo,['height'=>50]) ?>
<?=$form->field($model,'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map($brand,'id', 'name'), ['class' => 'dropdownlist']); ?>
<?=$form->field($model,'market_price')->textInput() ?>
<?=$form->field($model,'shop_price')->textInput() ?>
<?=$form->field($model,'stock')->textInput() ?>
<?=$form->field($model,'sort')->textInput() ?>
<?=$form->field($model,'is_on_sale')->radioList(\backend\models\Brand::$statusText) ?>
<?=$form->field($model,'status')->radioList(\backend\models\Brand::$statusText) ?>

<?php
// ActiveForm
echo $form->field($model, 'logo')->widget('manks\FileInput', []);

?>



<?=\yii\helpers\Html::submitButton('提交',['class'=>'btn btn-success'])?>



<?php $form=\yii\bootstrap\ActiveForm::end()?>
