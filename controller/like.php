<?php
require_once '../include/const.php';
require_once '../include/functions.php';


$user_id='';
$user_name = '';
session_start();
//今user登録状態判断
if (isset($_SESSION['user_id']) !== TRUE) {
   // ログアウト済みの場合、ログイン画面へリダイレクト
   header('Location:login.php');
   exit;
}else{
    $user_id = $_SESSION['user_id'];
    $user_id = intval($user_id);
}
//DB user_id チェック
if(($user_name = user_id_check($user_id)) === ''){
    $_SESSION['login_error'] = ['user存在していない。'];
    header('Location:login.php');
    exit;
}

include_once '../include/view/like_view.php';