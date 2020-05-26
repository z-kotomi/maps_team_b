<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>聖地詳細</title>
        <link rel="stylesheet" href="../css/main_style.css" type="text/css" />
    </head>
    <body>
        <header>
            <div class="header_box">
                <a href="main.php">
                    <img class="logo" src="../web_image/logo.png"></img>
                </a>
                <div class="header_menu">ユーザー：<?php print $user_name; ?></div>
                <div class="header_menu header_spe"><a class="header_link" href="logout.php">ログアウト</a></div>
                <div class="header_menu header_spe"><a class="header_link" href="">Menu</a></div>
                <div class="header_menu header_spe"><a class="header_link" href="like.php">気になる</a></div>
                <div class="header_menu header_spe"><a class="header_link" href="main.php">TOP</a></div>
            </div>
        </header>
        <section class="content">
<?php       foreach ($errors as $error) { ?>
            <p><?php print $error; ?></p>
<?php       } ?>
<?php   if($spots !== []){ ?>
            <h2 id="detail_h2"><?php print $spots['anime_name']; ?></h2>
            <h2 id="detail_h2"><?php print $spots['spot_id'] . '：' . $spots['spot_name']; ?></h2>
            <div id="detail_page_map_box"></div>
            <img class="detail_img" src="<?php print $spots['spot_image']; ?>" alt="イメージ"></img>
            <table class="detail_table">
                <tr>
                    <th>シーン</th>
                    <td><?php print $spots['spot_content']; ?></td>
                    
                </tr>
                <tr>
                    <th>営業施設</th>
                    <td><?php print $spots['business_name']; ?></td>
                </tr>
                <tr>
                    <th>営業時間</th>
                    <td><?php print $spots['business_time']; ?></td>
                </tr>
                <tr>
                    <th>価格</th>
                    <td><?php print $spots['price'] . '円'; ?></td>
                </tr>
                <tr>
                    <th>営業内容</th>
                    <td><?php print $spots['business_content']; ?></td>
                </tr>
                <tr>
                    <th>施設画像</th>
                    <td><img class="detail_business_img" src="<?php print $spots['business_image']; ?>" alt="イメージ"></td>
                </tr>
            </table>
<?php       } ?>
            <div class="return_div"><a  class="return_link" href="main.php">戻る</a></div>
        </section>
        <script>
            function initMap(){
                var map_spot = JSON.parse('<?php echo $spots_json; ?>');
                var map_box = document.getElementById('detail_page_map_box');
                var mapCenter = {
                    lat: parseFloat(map_spot["lat"]),
                    lng: parseFloat(map_spot["lng"])
                };
                var map = new google.maps.Map(
                      map_box,
                      {
                        center: mapCenter,
                        zoom: 16,
                        disableDefaultUI: true,
                        zoomControl: true,
                        clickableIcons: false,
                      }
                )
                
                var marker = new google.maps.Marker({
                    map: map,
                    position: mapCenter,
                });
            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=<?php echo API_KEY; ?>&callback=initMap"></script>
        <footer>
        <section class="foot_all">
            <p style="text-align:center"><a class="foot_link" href="question.php">お問い合わせ</a></p>
            <p class="footer_img"><img src="../web_image/team_logo.png"></img></p>
            <p style="text-align:center;color:black;font-size:10px"><small>Copyright &copy; B-Team All Rights Reserved.</small></p>
        </section>
        </footer>
    </body>
</html>