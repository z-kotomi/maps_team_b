<?php
require_once '../include/const.php';
require_once '../include/functions.php';
$select_result = 'false';

$data=[];
$user_id='';
$spot_id='';

if (get_request_method() === 'GET'){
    $user_id = $_GET['user_id'];
    $spot_id = $_GET['spot_id'];
}
$time = get_time();
$sql="INSERT INTO like_spot_table(user_id,spot_id,created_date,updated_date)
      VALUES({$user_id},{$spot_id},'{$time}','{$time}')";
$result = db_insert($sql);

if($result){
    $select_result = 'true';
    exit($select_result);
}else{
    $select_result = 'error:'.$sql;
    exit($select_result);
}