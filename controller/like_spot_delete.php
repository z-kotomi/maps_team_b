<?php
require_once '../include/const.php';
require_once '../include/functions.php';

function delete_like_spot($link, $like_spot_id){
    $sql = "DELETE from like_spot_table
            WHERE
                like_spot_id = {$like_spot_id}";
    return query_db($link, $sql);
}



if(is_post() === true){

    $like_spot_id = get_post_data('like_spot_id');

    if($place_id !== ''){
        $link = get_db_connect();
        if(delete_like_spot($link, $like_spot_id) === false){
            close_db_connect($link);
            exit('場所の削除に失敗しました。');
        }
        close_db_connect($link);
    }
}


redirect_to('like.php');