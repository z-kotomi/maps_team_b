<?php
require_once '../include/const.php';
require_once '../include/functions.php';

$address = '';
$lat = '';
$lng = '';
$anime_name = '';
$spot_name = '';
$spot_content = '';
$errors = [];
$message = '';

//POST値取得
if(get_request_method() === 'POST'){
    //map_top.phpからの受け取り
    $address = get_post_data('address');
    $lat = get_post_data('lat');
    $lng = get_post_data('lng');
    
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