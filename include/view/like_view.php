<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>気になるページ</title>
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
                <div class="header_nemu header_spe"><a class="header_link" href="">気になる</a></div>
                <div class="header_nemu header_spe"><a class="header_link" href="">TOP</a></div>
            </div>
        </header>
        <section class="content">
            <div>
                <table class="like_table">
                    <tr class="like_table_tr">
                        <th>番号</th>
                        <th>アニメ</th>
                        <th>スポット</th>
                        <th>操作</th>
                    </tr>
                    <?php if(count($like_data)==0){ ?>
                    <p>まだ気になるスポット入っていないな！</p>
                    <?php }else{ $i=0;?>
                    <?php foreach($like_data as $value){ ?>
                    <tr class="like_table_tr">
                        <td class="like_table_td"><p><?php print $labels[$i];?></p></td>
                        <td class="like_table_td"><?php print h($value['anime_name']);?></td>
                        <td class="like_table_td"><?php print h($value['spot_name']);?></td>
                        <td class="like_table_td">
                            <form method="post" action="like_spot_delete.php">
                                <input type="hidden" name="like_spot_id" value="<?php print h($value['like_spot_id']); ?>">
                                <input type="submit" value="削除">
                            </form>
                        </td>
                    </tr>
                    <?php $i++; }}?>
                </table>
            </div>
            <div id='creat_route'><img class="route_img"src="../web_image/creat_rout.png"></img></div>
            <div id="like_spot_map_box"></div>
        </section>
        <!--initMap is not fanction 解決策-->
        <script src="custom-js-google-map.js"></script> 
        <script async defer src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=<?php echo API_KEY; ?>&callback=initMap"></script>
        <script>
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var labelIndex = 0;
        var like_spot;
        function initMap(){
            var shinagawa = {
              lat: 35.6879192,
              lng: 139.7565577
            };
            var map_box = document.getElementById('like_spot_map_box');
            var map = new google.maps.Map(
              map_box,
              {
                center: shinagawa,
                zoom: 15,
                disableDefaultUI: true,
                zoomControl: true,
                clickableIcons: false,
              }
            );
            like_spot = JSON.parse('<?php echo $like_data_json; ?>');
            if(like_spot.length>0){
                addMaker(map);
            }
            // for(var i = 0;i<like_spot.length;i++){
            //     var like_spot_location = { 
            //         lat:parseFloat(like_spot[i]['lat']),
            //         lng:parseFloat(like_spot[i]['lng'])
            //     };
            //     console.log(like_spot_location);
            //     var marker = new google.maps.Marker({
            //         map: map,
            //         position: like_spot_location,
            //         title: like_spot[i]["spot_name"], 
            //         animation: google.maps.Animation.DROP,
            //     });
            // }
            
        }
          
        function addMaker(map){
            like_spot.forEach(function(value){
                var lat = parseFloat(value['lat']);
                var lng = parseFloat(value['lng']);
                var marker = new google.maps.Marker({
                    map: map,
                    position: {lat:lat,lng:lng},
                    label: labels[labelIndex++ % labels.length]
                });
            });
            document.getElementById('creat_route').addEventListener('click',routeCreat(map),false);
        }
        
        function routeCreat(map){
            var end = like_spot.pop();
            var wapp;
            for(var i = 0;i<like_spot.length;i++){
                var wapp = [{ 
                    lat:parseFloat(like_spot[i]['lat']),
                    lng:parseFloat(like_spot[i]['lng'])
                }];
            }
            var request = {
                origin: new google.maps.LatLng(parseFloat(like_spot[0]['lat']),parseFloat(like_spot[0]['lng'])), // 出発地
                destination: new google.maps.LatLng(end['lat'],end['lng']), // 目的地
                waypoints: [ // 経由地点(指定なしでも可)
                    { location: new google.maps.LatLng(35.630152,139.74044) },
                    { location: new google.maps.LatLng(35.507456,139.617585) },
                    { location: new google.maps.LatLng(35.25642,139.154904) },
                    { location: new google.maps.LatLng(35.103217,139.07776) },
                    { location: new google.maps.LatLng(35.127152,138.910627) },
                    { location: new google.maps.LatLng(35.142365,138.663199) },
                    { location: new google.maps.LatLng(34.97171,138.38884) },
                    { location: new google.maps.LatLng(34.769758,138.014928) },
                    ],
                travelMode: google.maps.DirectionsTravelMode.WALKING, // 交通手段(歩行。DRIVINGの場合は車)
            };
            var d = new google.maps.DirectionsService(); // ルート検索オブジェクト
            var r = new google.maps.DirectionsRenderer({ // ルート描画オブジェクト
                map: map, // 描画先の地図
                preserveViewport: true, // 描画後に中心点をずらさない
            });
            // ルート検索
            d.route(request, function(result, status){
            // OKの場合ルート描画
            if (status == google.maps.DirectionsStatus.OK) {
                r.setDirections(result);
                }
            });
        }
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