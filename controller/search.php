<?php
require_once '../include/const.php';
require_once '../include/functions.php';

$errors = [];
$data = [];
$result_message = '';
$result_list = [];
$user_id='';
$user_name = '';
$animes = [];

session_start();
//今user登録状態判断
if (isset($_SESSION['user_id']) !== TRUE) {
   // ログアウト済みの場合、ログイン画面へリダイレクト
}else{
    $user_id = $_SESSION['user_id'];
    $user_id = intval($user_id);
    //DB user_id チェック
    if(($user_name = user_id_check($user_id)) === ''){
        $_SESSION['login_error'] = ['user存在していない。'];
        header('Location:login.php');
        exit;
    }
}


//リクエストメソッドがポストならば
if(get_request_method() === 'POST'){
    //POST値取得
    $key_word = get_post_data('key_word');
    //POST値チェック
    if($key_word === '') {
        $errors[] = '聖地のキーワードを入力してください';
    }
    
    if(count($errors) === 0) {
        //DBハンドル取得
        $link = get_db_connect();
        //DBからPOST値とanime_table.anime_nameが部分一致するものをセレクト
        $sql = "SELECT anime_id, anime_name
                FROM anime_table
                WHERE anime_name LIKE '%{$key_word}%'";
        $data = get_as_array($link,$sql);

        //$dataの中身の有無で分岐
        if(empty($data)) {
            $result_message = '検索結果がありません';
        } else {
            $result_message = '検索結果:';
            $result_list = $data;
        }
        //DBclose
        close_db_connect($link);
    }
}
//DBハンドル取得
$link = get_db_connect();
$sql = "SELECT anime_id, anime_name
        FROM anime_table
        ";
$animes = get_as_array($link,$sql);
close_db_connect($link);

include_once '../include/view/search.php';