<?php
require_once '../include/const.php';
require_once '../include/functions.php';

$user_id='';
$address = '';
$lat = '';
$lng = '';
$anime_name = '';
$spot_name = '';
$spot_content = '';
$errors = [];
$message = '';


session_start();
//user_idを持っているか
if (isset($_SESSION['user_id']) !== TRUE) {
   //ログアウト済みの場合ログイン画面へリダイレクト
   $_SESSION['login_error'] = ['スポット追加はユーザ登録必要があります。<br>登録してください'];
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
//POST値取得
if(get_request_method() === 'POST'){

    //main.phpからの受け取り

    $address = get_post_data('new_address');
    $lat = get_post_data('new_lat');
    $lng = get_post_data('new_lng');
    
    //view/add_spot.phpからの受け取り
    $anime_name = get_post_data('anime_name');
    $spot_name = get_post_data('spot_name');
    $spot_content = get_post_data('spot_content');
    
    if($anime_name === ''){
        $errors[] = 'アニメの名前を入力してください';
    } 
    if($spot_name === ''){
        $errors[] = '聖地の名前を入力してください';
    }
    if($spot_content === ''){
        $errors[] = '聖地の説明を入力してください';
    }
    
    if(count($errors) === 0){
        //INSERT
        $sql = "INSERT INTO new_spot_table(anime_name,spot_name,spot_content,address,lat,lng)
                VALUES ('{$anime_name}', '{$spot_name}', '{$spot_content}', '{$address}', {$lat}, {$lng})";
        $result = db_insert($sql);
        if($result === FALSE){
            $errors[] = 'INSERT失敗' . $sql;
        } else {
            $message =  '新しい聖地の追加が完了しました！';
        }
    }
} 


include_once '../include/view/add_spot.php';