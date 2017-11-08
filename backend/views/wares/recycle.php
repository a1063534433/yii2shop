
<a href="<?php echo \yii\helpers\Url::to(['wares/index'])?>" class="btn btn-primary btn-lg active" role="button">返回</a>

<table class="table table-striped">

    <tr>
        <th>编号</th>
        <th>名称</th>
        <th>货号</th>
        <th>商品图标</th>
        <th>商品分类</th>
        <th>品牌</th>
        <th>市场价格</th>
        <th>本店价格</th>
        <th>库存</th>
        <th>排序</th>
        <th>录入时间</th>
        <th>操作</th>


    </tr>
    <?php foreach ($model as $model):?>
        <tr>
            <td><?php echo $model->id ?></td>
            <td><?php echo $model->name ?></td>
            <td><?php echo $model->sn ?></td>
            <td><?=\yii\bootstrap\Html::img($model->logo,['height'=>50,'class'=>'img-circle']) ?></td>
            <td><?php echo $model->wares_category_id ?></td>
            <td><?php echo $model->brand_id ?></td>
            <td><?php echo $model->market_price ?></td>
            <td><?php echo $model->shop_price ?></td>
            <td><?php echo $model->stock ?></td>
            <td><?php echo $model->sort ?></td>
            <td><?=date('Y-m-d H:i:s',$model->inputtime) ?></td>
            <td><a href="<?php echo \yii\helpers\Url::to(['wares/reduction','id'=>$model->id])?>" class="btn btn-warning" role="button">还原</a>
                <a href="<?php echo \yii\helpers\Url::to(['wares/remove','id'=>$model->id])?>" class="btn btn-danger" role="button">删除</a></td>

        </tr>
    <?php endforeach ;?>
</table>
