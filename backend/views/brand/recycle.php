

<table class="table table-striped">

    <tr>
        <th>编号</th>
        <th>商品名称</th>
        <th>商品图标</th>
        <th>排序</th>
        <th>商品状态</th>
        <th>操作</th>


    </tr>
    <?php foreach ($model as $model):?>
        <tr>
            <td><?php echo $model->id ?></td>
            <td><?php echo $model->name ?></td>
            <td><?=\yii\bootstrap\Html::img('@web/'.$model->logo,['height'=>30]) ?></td>
            <td><?php echo $model->sort ?></td>
            <td><?php echo $model->status ?></td>
            <td><a href="<?php echo \yii\helpers\Url::to(['brand/look','id'=>$model->id])?>" class="btn btn-warning" role="button">显示</a>
      </td>

        </tr>
    <?php endforeach ;?>
</table>