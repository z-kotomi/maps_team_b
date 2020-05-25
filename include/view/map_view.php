<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>Map画面</title>
        <link rel="stylesheet" href="../css/main_style.css" type="text/css" />
    </head>
    <body>
        <header>
            <div class="header_box">
                <a href="">
                    <img class="logo" src="../web_image/logo.png"></img>
                </a>
                <div class="header_nemu">ユーザー：<?php print $user_name; ?></div>
                <div class="header_nemu header_spe"><a class="header_link" href="logout.php">ログアウト</a></div>
                <div class="header_nemu header_spe"><a class="header_link" href="">Menu</a></div>
                <div class="header_nemu header_spe"><a class="header_link" href="like.php">気になる</a></div>
                <div class="header_nemu header_spe"><a class="header_link" href="search.php">TOP</a></div>
            </div>
        </header>
        <section class="content">
        　　<div id="map_page_map_box"></div>
<?php       foreach ($errors as $error) { ?>
            <p><?php print $error; ?></p>
<?php       } ?>

            <table class="list_table">
<?php   if($spots !== []){ ?>
                <caption><?php print $spots[0]['anime_name'] . "巡礼リスト" ;?></caption>
                <tr>
                    <th>No</th>
                    <th>場所</th>
                    <th>シーン</th>
                    <th>スポット画像</th>
                    <th>営業施設</th>
                    <th>営業時間</th>
                    <th>価格</th>
                    <th>営業内容</th>
                    <th>施設画像</th>
                    <th>気になる</th>
                </tr>
<?php           foreach ($spots as $spot){ ?>
                <tr>
                    <form method="post" action="map.php">
                        <input type="hidden" name="anime_id" value="<?php print $anime_id; ?>"/>
                        <td><?php print entity_str($spot['location_id']); ?></td>
                        <td><?php print entity_str($spot['spot_name']); ?></td>
                        <td><?php print entity_str($spot['spot_content']); ?></td>
                        <td><img src="<?php print entity_str($spot['spot_image']); ?>" alt="spot_image"></td>
                        <td><?php print entity_str($spot['business_name']); ?></td>
                        <td><?php print entity_str($spot['business_time']); ?></td>
                        <td><?php print entity_str($spot['price']); ?></td>
                        <td><?php print entity_str($spot['business_content']); ?></td>
                        <td><?php print entity_str($spot['business_image']); ?></td>
                        <td>
                            <button type ="submit" name="like_sport_id" value="<?php print entity_str($spot['spot_id']); ?>" >気になる登録</button>
                        </td>
                    </form>
                </tr>
<?php   } ?>
            </table>
           
<?php       } ?>
            <div><a href="search.php">検索画面に戻る</a></div>
        </section>
        <script>
            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var labelIndex = 0;
            var map_spot;
            var map;
            var markers = [];
            function initMap(){
                map_spot = JSON.parse('<?php echo $spots_json; ?>');
                console.log('hello');
                
                var map_box = document.getElementById('map_page_map_box');
                var mapCenter = {
                  lat: parseFloat(map_spot[0]['lat']),
                  lng: parseFloat(map_spot[0]['lng'])
                };
                map = new google.maps.Map(
                  map_box,
                  {
                    center: mapCenter,
                    zoom: 12,
                    disableDefaultUI: true,
                    zoomControl: true,
                    clickableIcons: false,
                  }
                );
                
                if(map_spot.length>0){
                    addMaker();
                }
            }
              
            function addMaker(){
                // console.log(like_spot);
                map_spot.forEach(function(value){
                    var lat = parseFloat(value['lat']);
                    var lng = parseFloat(value['lng']);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: {lat:lat,lng:lng},
                        label: labels[labelIndex++ % labels.length]
                    });
                    markers.push(marker);
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
