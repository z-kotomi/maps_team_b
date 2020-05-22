<?php
require_once '../include/const.php';
require_once '../include/functions.php';


$user_id='';
$user_name = '';
$like_data[]='';
$labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

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

$link = get_db_connect();
$sql = "SELECT like_spot_table.like_spot_id,spot_table.spot_name,anime_table.anime_name,
        location_table.lat,location_table.lng,spot_table.spot_content,spot_table.spot_image
        FROM like_spot_table 
        JOIN spot_table 
        ON spot_table.spot_id = like_spot_table.spot_id 
        JOIN anime_table 
        ON anime_table.anime_id = spot_table.anime_id
        JOIN location_table
        ON location_table.location_id = spot_table.location_id
        WHERE like_spot_table.user_id ={$user_id}";
$like_data = get_as_array($link,$sql);
//DB Close
close_db_connect($link);
// php array => Js 読み込むできるJSON
$like_data_json = json_encode($like_data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

include_once '../include/view/like_view.php';