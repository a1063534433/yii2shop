<a href="<?php echo \yii\helpers\Url::to(['article/index','id'=>$model->id])?>" class="btn btn-warning" role="button">返回</a>




<table class="table table-striped">
        <tr>
            <th>文章编号</th>
        </tr>
        <td><?php echo $model->id ?></td>

         <tr>
             <th>文章名</th>
         </tr>
    <td><?php echo $model->name ?></td>

    <tr>
             <th>所属分类</th>
         </tr>
    <td><?php echo $model->classify_id ?></td>

    <tr>
        <th>内容</th>
    </tr>
    <tr>
        <td><?php echo $model->content ?></td>
    </tr>

    <tr>
        <th>添加时间</th>
    </tr>
    <tr>
        <td><?=date('Y-m-d H:i:s',$model->inputtime) ?></td>
        </tr>

</table>
