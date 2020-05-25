<?php
require_once '../include/const.php';
require_once '../include/functions.php';

$anime_id = 0;
$anime_name = '';
$spots = [];
$errors = [];
//リクエストメソッド確認
if (get_request_method() !== 'GET'){
    //GETでなければ検索画面にリダイレクト
    header('Location:search.php');
    exit;
}
$anime_id = 1;
//検索されたアニメIDを取得
if (isset($_GET[$anime_id]) === TRUE) {
    $anime_id = $_GET[$anime_id];
}elseif($anime_id === 0) {
    $errors[] = '検索されたアニメが見つかりませんでした';
}

//サーバー接続
$link = get_db_connect();
//リスト情報を取得
$sql = "SELECT spot_id, location_id, anime_name, anime_name, spot_name, spot_content, spot_image, business_name, business_time, price, business_content, business_image
        FROM anime_table
        JOIN spot_table
        ON anime_table.anime_id = spot_table.anime_id
        WHERE spot_table.anime_id={$anime_id}";
if ($result = query_db($link, $sql)){
    while ($row = mysqli_fetch_assoc($result)){
            $spots[] = $row;
    }
    //メモリ開放
    mysqli_free_result($result);
} else {
        $errors[] = '検索されたアニメが見つかりませんでした:' . $sql;
}
//サーバー切断
close_db_connect($link);

include_once '../include/view/maps_view.php';
