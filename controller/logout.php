<?php
require_once '../include/const.php';
require_once '../include/functions.php';

//セッション全て削除
session_start();
$_SESSION = [];
$session_name = session_name();
if(isset($_COOKIE[$session_name])){
    setcookie($session_name,'',time() - 3600 );
}

session_destroy();
header('Location:login.php');
exit;