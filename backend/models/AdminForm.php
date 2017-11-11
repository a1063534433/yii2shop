<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2017/11/9
 * Time: 10:39
 */

namespace backend\models;


use yii\base\Model;

class AdminForm extends Model
{
    public $password;
    public $username;
    public $rememberMe=true;
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['rememberMe'], 'safe'],
        ];
    }
    public function attributeLabels()
    {
        return [

            'username' => '用户名',
            'password' => '用户密码',
            '$rememberMe' => 'rememberMe',

        ];
    }
}