<?php
require_once '../include/const.php';
require_once '../include/functions.php';


//リクエストメソッド確認
if (get_request_method() !== 'POST'){
    //POSTでなければ検索画面にリダイレクト
    header('Location:maps.php');
    exit;
}
$spot_id[] = get_post_data($spot_id, []);
$sql ="INSERT INTO like_spot_table(spot_id, user_id)
        VALUES ()";
$result = db_insert($sql);
