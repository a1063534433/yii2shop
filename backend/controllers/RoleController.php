<?php

namespace backend\controllers;

use backend\models\AuthItem;
use function Sodium\compare;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class  RoleController extends Controller
{
    public function actionIndex()
    {

        $auth=\Yii::$app->authManager;
        $role=$auth->getRoles();
        return $this->render('index',compact('role'));
    }

    /**
     * @return string
     */
    public function actionAdd(){
        $model=new AuthItem();
        $auth=\Yii::$app->authManager;
        $request=\Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()  ){

            //创建权限
            $role=$auth->createRole($model->name);
            //添加描述
            $role->description=$model->description;
            //保存
            if ($auth->add($role)){
                  //给用户添加权限
                if ($model->permission){
                    foreach ($model->permission as $permission){
                          //分别把权限添加到角色
                        $auth->addChild($role,$auth->getPermission($permission));

                    }
                }
            }
            \Yii::$app->session->setFlash("success","创建".$model->description."成功");
            return $this->refresh();
        }

        $permission=$auth->getPermissions();
        $permission=ArrayHelper::map($permission,"name","description");
        return $this->render('add',compact('model','permission'));
    }

    public function actionEdit($name){
        $auth=\Yii::$app->authManager;
        $model=AuthItem::findOne($name);
        $relePerm=$auth->getPermissionsByRole($name);
        //取数组所有键
        $model->permission=array_keys($relePerm);

        $request=\Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()  ){
            //创建权限
            $role=$auth->createRole($model->name);

            if ($role){
                //添加描述

                $role->description=$model->description;
                //保存

                if ($auth->update($model->name,$role)){

                    $auth->removeChildren($role);

                    if ($model->permission){
                        foreach ($model->permission as $permission){
                            //分别把权限添加到角色
                            $auth->addChild($role,$auth->getPermission($permission));

                        }
                    }
                \Yii::$app->session->setFlash("success","修改".$model->description."成功");
                return $this->redirect(['index']);

            }else {
                    \Yii::$app->session->setFlash("danger", "不能修改权限名称" . $model->description);
                    return $this->refresh();
                }
            }

        }
        $permission=$auth->getPermissions();
        $permission=ArrayHelper::map($permission,"name","description");
        return $this->render('add',compact('model','permission'));
    }
  public function actionDel($name){
        $model=\Yii::$app->authManager;
        //找到要删除的对象
      $role=$model->getRole($name);

      //删除权限
      if($model->remove($role) ){

          \Yii::$app->session->setFlash("success","删除".$name."成功");
          return $this->redirect(['index']);
      }

  }


}
