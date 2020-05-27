<?php
require_once '../include/const.php';
require_once '../include/functions.php';

$user_name = '';
$spots_data = [];
$errors = [];
$user_id = '';

$link = get_db_connect();
$sql = "SELECT spot_table.spot_id,anime_table.anime_name,spot_table.spot_name,spot_table.spot_content,
        spot_table.spot_image,location_table.lat,location_table.lng
        FROM spot_table
        JOIN anime_table
        ON anime_table.anime_id = spot_table.anime_id
        JOIN location_table
        ON location_table.location_id = spot_table.location_id";
$spots_data = get_as_array($link,$sql);
//DB Close
close_db_connect($link);
// php array => Js 読み込むできるJSON
$spots_data_json = json_encode($spots_data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_UNESCAPED_UNICODE);
$spots_data_json = str_replace('\n','',$spots_data_json); 

include_once '../include/view/main_view.php';