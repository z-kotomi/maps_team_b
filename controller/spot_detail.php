<?php
require_once '../include/const.php';
require_once '../include/functions.php';

$user_name = '';
//spot_id初期値0
$spot_id = '';
$spots = [];
$errors = [];
$kuchikomi = '';
$comments = [];
$comment = '';
//user_id初期値0
$user_id = '';
$user_name = '';
$created = '';
$not_exist_comments = '';

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



//リクエストメソッド確認
if (get_request_method() === 'GET'){
    $spot_id = $_GET['spot_id'];
}else if(get_request_method() === 'POST'){
    $spot_id = $_POST['spot_id'];
}
if($spot_id!==''){
    //スポット詳細取得の為のサーバー接続
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
    close_db_connect($link);
    
        //コメントの受取
    if (get_request_method() === 'POST'){
        if (isset($_POST['comment']) === TRUE) {
            $link = get_db_connect();
            $kuchikomi = $_POST['comment'];
           
            //comment_tableへの書き込みの為のサーバー接続
            //user_id, spot_id, comment, createdを記入するsql
            $link = get_db_connect();
            $log = date('Y-m-d H:i:s');
            $sql = "INSERT INTO 
                        comment_table(user_id, spot_id, comment, created)
                    VALUES
                        ({$user_id}, {$spot_id}, '{$kuchikomi}', '{$log}')";
            
            //sql実行
            $result = query_db($link, $sql);
            //メモリ開放
            //mysqli_free_result($result);
            if ($result === FALSE) {
                $errors[] = '口コミを追加できませんでした'.$sql;
            }
            close_db_connect($link);
        }
    }
    $link = get_db_connect();
    $sql = "SELECT 
                anime_user_table.user_name, comment, created
            FROM 
                comment_table
            JOIN 
                anime_user_table
            ON 
                anime_user_table.user_id = comment_table.user_id
            WHERE 
                comment_table.spot_id  = {$spot_id}";
    
    //sql実行
    if ($result = query_db($link, $sql)){
        while ($row = mysqli_fetch_assoc($result)) {
                $comments[] = $row;
            }
        //メモリ開放
        mysqli_free_result($result);
    } else {
        $not_exist_comments;
    }
    
    close_db_connect($link);
}


$spots_json = json_encode($spots, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_UNESCAPED_UNICODE);
$spots_json = str_replace('\n','',$spots_json); 

include_once '../include/view/spot_detail_view.php';