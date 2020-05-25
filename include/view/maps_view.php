<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/main_style.css" type="text/css" />
    </head>
    <body>
        <header>
            <div class="header_box">
                <a href="">
                    <img class="logo" src="../web_image/logo.png"></img>
                </a>
                <div class="header_nemu"><a class="header_link" href="">Menu</a></div>
                <div class="header_nemu header_spe"><a class="header_link" href="">気になる</a></div>
                <div class="header_nemu"><a class="header_link" href="">TOP</a></div>
            </div>
        </header>
        <section class="content">
            <!--ここに追加-->
<?php       foreach ($errors as $error) { ?>
            <p><?php print $error; ?></p>
<?php       } ?>
            <img src="../web_image/test.png"></img>
            <table class="list_table">
<?php   if($spots !== []){ ;?>
                <caption class="list_table_caption"><?php print $spots[0]['anime_name'] . "巡礼リスト" ;?></caption>
                <tr class="list_table_tr">
                    <th class="list_table_th">No</th>
                    <th class="list_table_th">場所</th>
                    <th class="list_table_th">シーン</th>
                    <th class="list_table_th">スポット画像</th>
                    <th class="list_table_th">営業施設</th>
                    <th class="list_table_th">営業時間</th>
                    <th class="list_table_th">価格</th>
                    <th class="list_table_th">営業内容</th>
                    <th class="list_table_th">施設画像</th>
                    <th class="list_table_th">気になる</th>
                </tr>
<?php           foreach ($spots as $spot){ ?>
                <tr class="list_table_tr">
                    <form method="post">
                        <td class="list_table_td"><?php print entity_str($spot['location_id']); ?></td>
                        <td class="list_table_td"><?php print entity_str($spot['spot_name']); ?></td>
                        <td class="list_table_td"><?php print entity_str($spot['spot_content']); ?></td>
                        <td class="list_table_td"><img src="<?php print entity_str($spot['spot_image']); ?>" alt="spot_image"></td>
                        <td class="list_table_td"><?php print entity_str($spot['business_name']); ?></td>
                        <td class="list_table_td"><?php print entity_str($spot['business_time']); ?></td>
                        <td class="list_table_td"><?php print entity_str($spot['price']); ?></td>
                        <td class="list_table_td"><?php print entity_str($spot['business_content']); ?></td>
                        <td class="list_table_td"><?php print entity_str($spot['business_image']); ?></td>
                        <td class="list_table_td"><input type="checkbox" name="spot_id[]" value="<?php print entity_str($spot['spot_id']); ?>"></td>
                    </form>
                </tr>
<?php   } ?>
            </table>
            <form id="form">
                <div class="like_button"><input class="like_submit" type ="submit" value="気になる登録"></div>   
            </form>
<?php       } ?>
            <div><a class="return_link" href=".php">検索画面に戻る</a></div>
        </section>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script>
            $(function(){
              // #formのsubmitがクリックされた時に
              $('#form').submit(function(){
                // ajaxでリクエストを送信
                $.ajax({
                    // リクエストの送信先
                    url: 'like_update.php',
                    type: 'post'
                }).fail(function(){
                  alert('エラーです');
                });
              });
            });
        </script>
    </body>
    <footer>
        <section class="foot_all">
            <p style="text-align:center"><a class="foot_link" href="question.php">お問い合わせ</a></p>
            <p class="footer_img"><img src="../web_image/team_logo.png"></img></p>
            <p style="text-align:center;color:black;font-size:10px"><small>Copyright &copy; B-Team All Rights Reserved.</small></p>
        </section>
    </footer>
</html>