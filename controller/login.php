<?php
require_once '../include/const.php';
require_once '../include/functions.php';

//変数初期化
$error=[];
session_start();
if (isset($_SESSION['user_id']) === TRUE) {
   // ログイン済みの場合、ホームページへリダイレクト
   //*****/
   $goto_next_page = 'main.php';
    if(isset($_SESSION['after_login_goto_page'])){
        $goto_next_page = $_SESSION['after_login_goto_page'];
    }
    header('Location:'.$goto_next_page);
    unset($_SESSION['after_login_goto_page']);;
   exit;
}
if(isset($_SESSION['login_error'])){
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
include_once '../include/view/login_view.php';