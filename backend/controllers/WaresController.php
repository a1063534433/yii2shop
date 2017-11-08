<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\GoodsIntro;
use backend\models\Menu;
use backend\models\Wares;
use flyok666\qiniu\Qiniu;
use yii\web\Controller;

class WaresController extends Controller
{
    //显示主视图
    public function actionIndex()
    {
        $model=Wares::find()->where(['status'=>1])->all();
        return $this->render('index',['model'=>$model]);
    }
    //搜索
    public function actionSeek(){
        $request = \Yii::$app->request;
        $keyword=$request->get('keyword');
        $minPrice=$request->get('minPrice');
        $maxPrice=$request->get('maxPrice');
        if ($minPrice and $maxPrice){
            $model=Wares::find()->andWhere("shop_price <= {$maxPrice} and shop_price >= {$minPrice}")->all();
        }else{
            if ($minPrice>0){
                $model=Wares::find()->andWhere("{$minPrice} <= shop_price")->all();
            }
            if ($maxPrice>0){
                $model=Wares::find()->andWhere("shop_price <= {$maxPrice}")->all();
            }
        }

        if ($keyword){
            $model=Wares::find()->andWhere(" name like '%{$keyword}%' or sn like '%{$keyword}%'")->all();
        }

        \Yii::$app->session->setFlash('success','---------搜索结果---------');
        return $this->render('seek',['model'=>$model]);
    }
 //添加
    public function actionAdd(){
        $model=new Wares();
        $good=Menu::find()->all();
        $brand=Brand::find()->all();
        $request = \Yii::$app->request;
        if ($request->isPost) {

            //1. 绑定数据
            if ($model->load($request->post())  && $model->validate()) {
               //6 保存数据
                 $model->save();
                if($model->id<"10"){
                    $model->sn=date('Ymd',$model->inputtime)."0000".$model->id;
                }elseif($model->id<"100"){
                    $model->sn=date('Ymd',$model->inputtime)."000".$model->id;
                }elseif($model->id<"1000"){
                    $model->sn=date('Ymd',$model->inputtime)."00".$model->id;
                }elseif($model->id<"10000"){
                    $model->sn=date('Ymd',$model->inputtime)."0".$model->id;
                }elseif($model->id<'100000'){
                    $model->sn=date('Ymd',$model->inputtime).$model->id;
                }

                $model->save();
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['index']);
            }

        }
        $model->status = 1;
        $model->is_on_sale=1;
        return $this->render('add', ['model' => $model,'good'=>$good,'brand'=>$brand]);
    }
    //编辑
    public function actionEdit($id){
        $model=Wares::findOne($id);
        $good=Menu::find()->all();
        $brand=Brand::find()->all();
        $request = \Yii::$app->request;
        if ($request->isPost) {

            //1. 绑定数据
            if ($model->load($request->post())  && $model->validate()) {
                //6 保存数据
                $model->save();
                \Yii::$app->session->setFlash('success','修改成功');
                return $this->redirect(['index']);
            }

        }
        $model->status = 1;
        $model->is_on_sale=1;
        return $this->render('edit', ['model' => $model,'good'=>$good,'brand'=>$brand]);
    }
//移到回收站
    public function actionDel($id)
    {
        //找到对象
        $model=Wares::findOne($id);
        //删除
        $model->status=0;
        $model->save();
        //跳转
        $this->redirect(['index']);

    }
    //还原
    public function actionReduction($id)
    {
        //找到对象
        $model=Wares::findOne($id);
        //删除
        $model->status=1;
        $model->save();
        //跳转
        $this->redirect(['index']);

    }
    //彻底删除
    public function actionRemove($id)
    {
        //找到对象
        $model=Wares::findOne($id);
        $goods=GoodsIntro::find()->where(['id'=>$id])->all();
        //删除
       $model->delete();
       if ($goods){
           $goods->delete();
       }
        //跳转
        $this->redirect(['recycle']);

    }
    //回收站
    public function actionRecycle(){
        $model=Wares::find()->where(['status'=>0])->all();
        return $this->render('recycle',['model'=>$model]);
    }
    //七牛云上传
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
