<?php
require_once '../include/const.php';
require_once '../include/functions.php';

$user_name = '';
$anime_id = '';
$anime_name = '';
$spots = [];
$errors = [];
$add_like = '';
$like_spot_id = '';
$user_id = '';
$user_like_spot_data = [];
$u_l_data = [];

session_start();
//今user登録状態判断
if (isset($_SESSION['user_id']) !== TRUE) {
   // ログアウト済みの場合

}else{
    $user_id = $_SESSION['user_id'];
    $user_id = intval($user_id);
}
//DB user_id チェック
if($user_id!==''){
    if(($user_name = user_id_check($user_id)) === ''){
    $_SESSION['login_error'] = ['user存在していない。'];
    header('Location:map.php');
    exit;
    }else{
        $sql = "SELECT spot_id FROM like_spot_table
                WHERE user_id = {$user_id}";
        $link = get_db_connect();
        $user_like_spot_data = get_as_array($link,$sql);
        //DB Close
        close_db_connect($link);
    }
}

//リクエストメソッド確認
if (get_request_method() === 'POST'){
    $like_spot_id = get_post_data('like_spot_id');
    $add_like = get_post_data('add_like');
    
    if($like_spot_id!==''){
        if($user_id !== ''){
            $like_spot_id = intval($like_spot_id);
            $time = get_time();
            $sql = "INSERT INTO like_spot_table(spot_id,user_id,created_date,updated_date)
                    VALUES ({$like_spot_id},{$user_id},'{$time}','{$time}')";
            $aaa = db_insert($sql);
        }else{
            echo "<script>alert('登録下さい');location.href='login.php';</script>";
            $_SESSION['after_login_goto_page'] = 'map.php';
        }
    }
}


//検索されたアニメIDを取得
if (isset($_GET['anime_id']) === TRUE) {
    $anime_id = $_GET['anime_id'];
    if($anime_id ==''){
        $errors[] = '検索されたアニメが見つかりませんでした';
    }else{
        $anime_id = intval($anime_id);
        $_SESSION['login_goto_map_anime_id'] = $anime_id;
    }
}else if(get_request_method() === 'POST'){
    $anime_id = get_post_data('anime_id');
    if($anime_id ==''){
        $errors[] = '検索されたアニメが見つかりませんでした';
    }else{
        $anime_id = intval($anime_id);
    }
}

//サーバー接続
$link = get_db_connect();
//リスト情報を取得
$sql = "SELECT spot_table.spot_id, location_table.location_id, 
        anime_table.anime_name,spot_table.spot_name, 
        spot_table.spot_content,spot_table.spot_image, spot_table.business_name, 
        spot_table.business_time, spot_table.price, spot_table.business_content, spot_table.business_image,
        location_table.lat,location_table.lng 
        FROM anime_table 
        JOIN spot_table 
        ON anime_table.anime_id = spot_table.anime_id 
        JOIN location_table 
        ON location_table.location_id = spot_table.location_id 
        WHERE spot_table.anime_id={$anime_id}";

if ($result = query_db($link, $sql)){
    while ($row = mysqli_fetch_assoc($result)){
            $spots[] = $row;
    }
    //メモリ開放
    mysqli_free_result($result);
} else {
        $errors[] = '検索されたアニメが見つかりませんでした:';
}
//サーバー切断
close_db_connect($link);

///*****///
$spots_json = json_encode($spots, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_UNESCAPED_UNICODE);
//str内容変更
$spots_json = str_replace('\n','',$spots_json); 
//console エラー内容を具体的な横を表示
foreach($user_like_spot_data as $value){
    array_push($u_l_data,$value['spot_id']); 
}

$user_like_spot_data_json = json_encode($u_l_data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_UNESCAPED_UNICODE);
$user_like_spot_data_json = str_replace('\n','',$user_like_spot_data_json); 

include_once '../include/view/map_view.php';
