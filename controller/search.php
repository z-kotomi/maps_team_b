<?php
require_once '../include/const.php';
require_once '../include/functions.php';

$errors = [];
$data = [];
$result_message = '';
$result_list = [];

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


include_once '../include/view/search.php';