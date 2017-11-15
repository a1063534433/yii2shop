<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\UploadedFile;
use flyok666\qiniu\Qiniu;
class BrandController extends Controller
{
    public function actionIndex()
    {
     /*   $count=Brand::find()->count();
        $pageSize=3;
        $page=new Pagination(
          [
              'pageSize'=>$pageSize,
              'totalCount'=>$count
          ]
    );*/
       $models=new Brand();
        $model=Brand::find()->where(['status'=>1])->orderBy('sort')->all();
        $models->status='上线';
        return $this->render('index',['model'=>$model,'models'=>$models]);
    }

    public function actionAdd()
    {

        $model = new Brand();
        //判断是不是POST提交
        $request = \Yii::$app->request;
        if ($request->isPost) {
//            var_dump($request->post());die();
            //1. 绑定数据
            if ($model->load($request->post())  && $model->validate()) {


//                //6 保存数据
                $model->save();
                \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['index']);
            }

        }
        $model->status = 1;
        return $this->render('add', ['model' => $model]);
    }
  public function actionEdit($id){
      $model=Brand::findOne($id);
      //判断是不是POST提交
      $request = \Yii::$app->request;
      if ($request->isPost) {
          //1. 绑定数据
          $model->load($request->post());
          if ($model->validate()) {

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
    public function actionUploder(){
        $config = [
            'accessKey'=>'HURnNTvrk79TxHd_mgz7Iz3rIujgTjwSZCidY4w0',
            'secretKey'=>'UN6-QUKU2LSoT3aFVDGkNXwOszTy26BCxSaVs81A',
            'domain'=>'http://oyve5snrl.bkt.clouddn.com/',
            'bucket'=>'yangke',
            'area'=>Qiniu::AREA_HUANAN
        ];



        $qiniu = new Qiniu($config);
        $key = time();
        $qiniu->uploadFile($_FILES["file"]['tmp_name'],$key);
        $url = $qiniu->getLink($key);

        $info=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url
        ];
            echo json_encode($info);
    }

}
