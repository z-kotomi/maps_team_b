<?php
require_once '../include/const.php';
require_once '../include/functions.php';

$user_name = '';
$spot_id = 0;
$spots = [];
$errors = [];

//リクエストメソッド確認
if (get_request_method() === 'GET'){
    $spot_id = $_GET['spot_id'];
}

//サーバー接続
$link = get_db_connect();
//スポット詳細情報取得
$sql = "SELECT anime_name, spot_table.spot_id, location_table.location_id, 
        spot_table.spot_name, 
        spot_table.spot_content,spot_table.spot_image, spot_table.business_name, 
        spot_table.business_time, spot_table.price, spot_table.business_content, spot_table.business_image,
        location_table.lat,location_table.lng 
        FROM anime_table
        JOIN spot_table
        ON anime_table.anime_id = spot_table.anime_id
        JOIN location_table
        ON location_table.location_id = spot_table.location_id 
        WHERE spot_table.spot_id = {$spot_id}";
//sql実行
if ($result = query_db($link, $sql)){
    $spots = mysqli_fetch_assoc($result);
    //メモリ開放
    mysqli_free_result($result);
} else {
    $errors[] = '詳細情報が見つかりませんでした:';
}

//サーバー切断
close_db_connect($link);

$spots_json = json_encode($spots, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_UNESCAPED_UNICODE);
$spots_json = str_replace('\n','',$spots_json); 

include_once '../include/view/spot_detail_view.php';