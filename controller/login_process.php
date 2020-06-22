<?php
require_once '../include/const.php';
require_once '../include/functions.php';
//変数初期化
$user_name = '';
$password ='';
$error=[];

$requset_method = get_request_method();
if($requset_method === 'POST'){
    $user_name = get_post_data('user_name');
    $password = get_post_data('password');
}else{
    header('Location:login.php');
    exit;
}

session_start();
//post name & pw check
if($user_name === ''){
    $error[]='ユーザー名を入力してください。';
}
if($password === ''){
    array_push($error,'パスワードを入力してください。');
}
if(count($error)>0){
    $_SESSION['login_error'] = $error;
    header('Location:login.php');
    exit;
}
//db select name & pw
//DB link
$link = get_db_connect();
$sql = "SELECT user_id
        FROM anime_user_table
        WHERE user_name ='{$user_name}' AND password = '{$password}'";
$data = get_as_array($link,$sql);
//DB Close
close_db_connect($link);

//name & pw クエリ結果判断
if(isset($data[0]['user_id'])){
    // //adminの場合user_idを保存しない
    // if($data[0]['user_id'] == 1){
    //     //今adminログインしているかどうか判断する
    //     // ログインしている場合、再ログインできません
    //     if(isset($_SESSION['admin'])){
    //         if($_SESSION['admin'] === true){
    //             $_SESSION['login_error']=['現在管理者登録中です。'];
    //             header('Location:login.php');
    //             exit;
    //         }
    //     }
    //     $_SESSION['admin'] = true;
    //     $time = get_time();
    //     $sql="UPDATE ec_user_table
    //           SET updated_date = '{$time}'
    //           WHERE user_id = 1";
    //     if(db_update($sql)===false){
    //         $error[] = 'ログイン時間記録失敗。';
    //     }
    //     header('Location:goods_tool.php');
    //     exit;
    // }
    // セッション変数にuser_idを保存
    $_SESSION['user_id'] = $data[0]['user_id'];
    $user_id = intval($data[0]['user_id']);
    //login time 記録
    $time = get_time();
    $sql="UPDATE anime_user_table
          SET updated_date = '{$time}'
          WHERE user_id = {$user_id}";
    if(db_update($sql)===false){
        $error[] = 'ログイン時間記録失敗。';
    }
    
    header('Location:login.php');
    exit;
}else{
    $_SESSION['login_error'] = ['ユーザー名あるいはパスワードが違います'];
    header('Location:login.php');
    exit;
}