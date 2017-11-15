<a href="<?php echo \yii\helpers\Url::to(['add'])?>" class="btn btn-warning" role="button">添加角色</a>
<table class="table table-striped">

    <tr>
        <th>角色名称</th>
        <th>角色描述</th>
        <th>权限</th>
        <th>操作</th>




    </tr>
    <?php foreach ($role as $role):?>
        <tr>
            <td>
                <?php echo $role->name ?></td>
            <td><?php echo $role->description ?></td>
        <td>
            <?php
                      $auth=Yii::$app->authManager;
                      //得到当前角色的权限
               $pers=$auth->getPermissionsByRole($role->name);
            foreach ($pers as $per){

                echo $per->description."--";
            }
            ?>
            </td>
            <td>
                <a href="<?php echo \yii\helpers\Url::to(['edit','name'=>$role->name])?>" class="btn btn-warning" role="button">编辑</a>
                <a href="<?php echo \yii\helpers\Url::to(['del','name'=>$role->name])?>" class="btn btn-danger" role="button">删除</a></td>
        </tr>
    <?php endforeach ;?>
</table>
