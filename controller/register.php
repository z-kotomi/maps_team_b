<?php
require_once '../include/const.php';
require_once '../include/functions.php';
//変数初期化
$data =[];
$new_user_name = '';
$new_pw = '';
$error = [];
$register = false;

$requset_method = get_request_method();
if($requset_method === 'POST'){
    $new_user_name = get_post_data('new_user_name');
    $new_pw = get_post_data('new_password');

    if($new_user_name === '' || $new_pw === ''){
        $error[] = 'ユーザー名あるいはパスワード未入力です';
    }else{
        if(preg_match(UN_PW_REGEXP,$new_user_name)!==1){
            $error[] = 'ユーザー名は6文字以上１０文字以下の半角英数字入力してください';
        }
        if(preg_match(UN_PW_REGEXP,$new_pw)!==1){
            array_push($error,'パスワードは6文字以上１０文字以下の半角英数字入力してください');
        }
    }
    if(count($error) === 0){
        //DB new userName Check
        if(!new_user_name_db_check($new_user_name)){
            $error[] = '同じユーザー名が既に登録されています';
        }
    }
    if(count($error) === 0){
        //new userName&Pw DB write
        $time = get_time();
        $sql = "INSERT INTO anime_user_table(user_name,password,created_date,updated_date) 
                VALUES('{$new_user_name}','{$new_pw}','{$time}','{$time}')";
        if(db_insert($sql) === false){
            $error[] = '新ユーザー名DBインセット失敗';
        }else{
            $register = true;
        }
    }
}
include_once '../include/view/register_view.php';