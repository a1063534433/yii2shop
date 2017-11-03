<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\web\Controller;
use yii\web\UploadedFile;

class BrandController extends Controller
{
    public function actionIndex()
    {
        $model=Brand::find()->where(['status'=>1])->all();
        return $this->render('index',['model'=>$model]);
    }

    public function actionAdd(){
        $model=new Brand();
        //判断是不是POST提交
        $request = \Yii::$app->request;
        if ($request->isPost) {
            //1. 绑定数据
            $model->load($request->post());
            //2. 创建文件上传对象
            $model->imgFile = UploadedFile::getInstance($model, "imgFile");
            if ($model->validate()) {
                if ($model->imgFile) {
                    $filePath = "images/" . time() . "." . $model->imgFile->extension;
                    //文件保存
                    $model->imgFile->saveAs($filePath, false);
                    //保存数据
                    $model->logo = $filePath;
                };
                //5 设置真实图片路径
                //6 保存数据
                if ( $model->save(false)) {
                    \Yii::$app->session->setFlash("success", "添加成功");
                    return $this->redirect(['index']);
                }
            } else {
                //得到验证错误信息
                var_dump($model->getErrors());
                exit;
            }
        }
          $model->status=1;
        return $this->render('add',['model'=>$model]);
    }
  public function actionEdit($id){
      $model=Brand::findOne($id);
      //判断是不是POST提交
      $request = \Yii::$app->request;
      if ($request->isPost) {
          //1. 绑定数据
          $model->load($request->post());
          //2. 创建文件上传对象
          $model->imgFile = UploadedFile::getInstance($model, "imgFile");
          if ($model->validate()) {
              if ($model->imgFile) {
                  $filePath = "images/" . time() . "." . $model->imgFile->extension;
                  //文件保存
                  $model->imgFile->saveAs($filePath, false);
                  //保存数据
                  $model->logo = $filePath;
              };
              //5 设置真实图片路径
              //6 保存数据
              if ( $model->save(false)) {
                  \Yii::$app->session->setFlash("success", "添加成功");
                  return $this->redirect(['index']);
              }
          } else {
              //得到验证错误信息
              var_dump($model->getErrors());
              exit;
          }
      }
      $model->status=1;
      return $this->render('add',['model'=>$model]);
  }


    public function actionDel($id)
    {
        //找到对象
        $model=Brand::findOne($id);
        //删除
        $model->status=0;
        $model->save();
        //跳转
        $this->redirect(['index']);

    }
    public function actionRecycle(){
        $model=Brand::find()->where(['status'=>0])->all();
        return $this->render('recycle',['model'=>$model]);
    }
    public function actionLook($id)
    {
        //找到对象
        $model=Brand::findOne($id);
        //还原
        $model->status=1;
        $model->save();
        //跳转
        $this->redirect(['index']);

    }

}
