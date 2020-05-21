<?php
/**
* DBハンドルを取得
* @return obj $link DBハンドル
*/
function get_db_connect() {
    // コネクション取得
    if (!$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME)) {
        die('error: ' . mysqli_connect_error());
    }
    // 文字コードセット
    mysqli_set_charset($link, DB_CHARACTER_SET);
    return $link;
}
/**
 * DB goods追加 
 * @param $newName,$newPrice,$newStock,$newStatus,$newImage_adress
 * 
 * @return 
 */
function db_goods_add($link,$newName,$newPrice,$newStock,$newStatus,$newImage_adress){
    $error = [];
    $time = date('Y-m-d H:i:s');
    mysqli_autocommit($link,false);
    //info_table INSERT
    $sql = "INSERT INTO 
           ec_goods_item_table(goods_name,goods_price,goods_img,goods_status,created_date,updated_date)
           VALUES('{$newName}',{$newPrice},'{$newImage_adress}',{$newStatus},'{$time}','{$time}')";
    $result = mysqli_query($link,$sql);
    if($result === false){
        $error[] = 'info_tableに追加失敗しました。';
    }
    //get drink ID
    $goods_id = mysqli_insert_id($link);
    //stock_table INSERT
    $sql="INSERT INTO 
         ec_goods_stock_table(goods_id,stock,created_date,updated_date)
         VALUES ({$goods_id},{$newStock},'{$time}','{$time}')";
    $result = mysqli_query($link,$sql);
    if($result === false){
        $error[] = 'stock_tableに追加失敗しました。';
    }
    if(count($error) == 0){
        mysqli_commit($link);
    }else{
        mysqli_rollback($link);
    }
    return $error;
}

/**
* クエリを実行しその結果を配列で取得する
*
* @param obj  $link DBハンドル
* @param str  $sql SQL文
* @return array 結果配列データ
*/
function get_as_array($link, $sql) {
 
    // 返却用配列
    $data = [];
 
    // クエリを実行する
    if ($result = mysqli_query($link, $sql)) {
 
        if (mysqli_num_rows($result) > 0) {
 
            // １件ずつ取り出す
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
 
        }
 
        // 結果セットを開放
        mysqli_free_result($result);
 
    }
 
    return $data;
 
}
/**
 * DB LINK CLOSE
 * @param object $link
 */
function close_db_connect($link){
    mysqli_close($link);
}

/**
 * DB Selsect 結果取得
 * @param object $link
 * @param String &sql
 * @return Array data[]
 */
// function select_db_as_array($link,$sql){
//     $data=[];
//     if($result = mysqli_query($link,$sql)){
//         //クエリ結果有無判断
//         if(mysqli_num_rows($result) > 0){
//             while($row = mysqli_fetch_assoc($result)){
//                 $data[] = $row;
//             }
//         }
//         mysqli_free_result($result);
//     }
// }



/**
* リクエストメソッドを取得
* @return str GET/POST/PUTなど
*/
function get_request_method() {
   return $_SERVER['REQUEST_METHOD'];
}

/**
* POSTデータを取得
* @param str $key 配列キー
* @return str　不为空 POST値
*               空     “”
*/
function get_post_data($key) {
   $str = '';
   if (isset($_POST[$key]) === TRUE) {
       $str = $_POST[$key];
   }
   return $str;
}


/**
* Image type、存在チェック
* @param  str  $name  Input file Name
* @param  str  $img_dir  Image保存位置
* @return no error --> str $newImage_adress
*         error    --> array $error
* 判断is_array() $error->true ;$newImage_adress->false
*/
function img_checksave($name,$img_dir){
    $phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
    );
    $error = [];
    $allowedExts = ['jpeg','png'];
    $temp = explode(".", $_FILES[$name]['name']);
    $extension = end($temp);
    if($_FILES[$name]['size'] == 0){
        $error[]='ファイルを選択してください。';
    }else{
        //ファイルtype確認
        if(in_array($extension,$allowedExts) === false){
            $error[]='ファイル形式が異なります。画像ファイルはJPEG又はPNGのみ利用可能です。';
        }
        if($_FILES[$name]['error'] > 0){
            //Upload 失敗error指定
            $error[] = 'Image file Upload error:'.$phpFileUploadErrors[$_FILES[$name]['error']];
        }
    }
    
    if(count($error) === 0){
        // 保存用ユーニック画像 Name 生成
        $image_save_name = md5(uniqid(mt_rand(),true)).'.'.$extension;
        // 今drink_Image/下にファイルは存在するかどうか判断する
        if(file_exists($img_dir.$image_save_name)){
            $error[]='もう一度アップロードしてください';
        }else{
        // ファイル保存
            move_uploaded_file($_FILES[$name]['tmp_name'],$img_dir.$image_save_name);
            //ファイル保存アドレス"drink_Image/" . $image_save_name
            $newImage_adress = $img_dir.$image_save_name;
            return $newImage_adress;
        }
    }else{
        return $error;
    }
}

 
/**
* 特殊文字をHTMLエンティティに変換する
* @param str  $str 変換前文字
* @return str 変換後文字
*/
function entity_str($str) {
    return htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
}

/**
* PHP log print
* @param str  $name  log名前
* @param str  $str log内容
*/
function log_write_str($name,$str){
    $time = date('h:i:s');
    $fp = fopen('./bug_log.txt', 'a');
    fwrite($fp,$time.'/*'.$name.'*/'.$str."\n");
    fclose($fp);
}
/**
* PHP log print
* @param str  $name  log名前
* @param str  $array arraylog内容
*/
function log_write_array($name,$array){
    $time = date('h:i:s');
    $fp = fopen('./bug_log.txt', 'a');
    $i = 0;
    if(isset($array)){
        if(count($array)===0){
            fwrite($fp,$time.'/*'.$name.'*/ は 空'."\n");
        }else{
            if(count($array) == count($array,COUNT_RECURSIVE)){
                foreach($array as $value){
                    fwrite($fp,$time.'/*'.$name.'*/['.$i.']:'.$value."\n");
                    $i++;
                }
            }else{
                foreach($array as $key=>$value){
                    if(count($value)===0){
                        fwrite($fp,$time.'/*'.$name.'*/'.'['.$key.'] is 空'."\n");
                    }else{
                        $i = 0;
                        foreach($value as $v){
                            fwrite($fp,$time.'/*'.$name.'*/'.'['.$key.']'.'['.$i.']:'.$v."\n");
                            $i++;
                        }
                    }
                }
            }
        }
    }else{
        fwrite($fp,$time.'/*'.$name.'*/ is NULL'."\n");
    }
    fclose($fp);
}

function get_time(){
    return date('Y-m-d H:i:s');
}

/**
 * DBインセント
 * @param str $sql
 * @return  true || false
**/
function db_insert($sql){
    $link = get_db_connect();
    $result = query_db($link,$sql);
    close_db_connect($link);
    return $result;
}
/**
 * DBアプデータ
 * @param str $sql
 * @return  true || false
**/
function db_update($sql){
    $link = get_db_connect();
    $result = query_db($link,$sql);
    close_db_connect($link);
    return $result;
}

/**
 * print関数
**/
function print_data($data){
    var_dump($data);
    exit;
}