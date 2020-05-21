<?php
 
define('TAX', 1.05);  // 消費税
 
define('DB_HOST',   'localhost'); // データベースのホスト名又はIPアドレス
define('DB_USER',   '');  // MySQLのユーザ名
define('DB_PASSWD', '');    // MySQLのパスワード
define('DB_NAME',   '');    // データベース名
 
define('HTML_CHARACTER_SET', 'UTF-8');  // HTML文字エンコーディング
define('DB_CHARACTER_SET',   'UTF8');   // DB文字エンコーディング
define('NUM_REGEXP','/^[0-9]+$/'); //数字チック用
define('UN_PW_REGEXP','/[!-~]{6,15}/');//user_name&PWチック用
//毎日変わるかもしれない
define('API_KEY', '') ;//google map Api