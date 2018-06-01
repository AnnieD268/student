<?php
namespace app\admin\controller;

use core\Controller;
use core\view\View;
use system\model\User;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class Login extends Controller{

//    加载登录模板方法
    public function loginForm(){
//        判断如果是post请求，就处理登录
        if ($_POST){
            $post = $_POST;
//            判断验证码是否输入正确
            if ($post['code'] != $_SESSION['code']){
                return $this -> redirect() -> message('验证码输入错误');
            }

//            找到对应的用户名和密码，判定是否可以登录成功
            $userInfo = User::where('username = "'.$post['username'].'" and password = "'.md5($post['password']).'"') -> get() -> toArray();
            if ($userInfo){
//                判断用户是否勾选了remember me,如果勾选了，会有字段值autologin，如果没有勾选就没有
                if (isset($post['autologin'])){
//                    如果勾选了，就在cookie存一个7天有效期的值
                    setcookie(session_name(),session_id(),time()+7*24*3600,'/');
                }
//                将用户名和id存入session中
                $_SESSION['username'] = $userInfo[0]['username'];
                $_SESSION['uid'] = $userInfo[0]['id'];
//                登陆成功
                return $this -> redirect('index.php?s=home/entry/index') -> message('登陆成功');
            }else{
                return $this -> redirect() -> message('账户或密码输入错误');
            }

        }
        return View::make();
    }

//    退出登录
    public function logout(){
//        清除session内容
        session_unset();
        session_destroy();
//        跳转去后台登录
        return $this -> redirect('index.php') -> message('退出成功');
    }

    /**
     * 生成验证码方法
     */
    public function code(){
        $phraseBuilder = new PhraseBuilder(4,'1234567890');

// Pass it as first argument of CaptchaBuilder, passing it the phrase
// builder
        $builder = new CaptchaBuilder(null, $phraseBuilder);
        $builder->build();
        header('Content-type: image/jpeg');
        $builder->output();
        //将生成的验证码存入session
        $_SESSION['code'] = $builder->getPhrase();
    }

}


?>