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
                <div class="header_nemu header_spe"><a class="header_link" href="search.php">TOP</a></div>
            </div>
        </header>
        <section class="content">
            <div class="like_table_content">
                <table class="like_table">
                    <tr class="like_table_tr">
                        <th class="like_table_th">番号</th>
                        <th class="like_table_th">アニメ</th>
                        <th class="like_table_th">スポット</th>
                        <th class="like_table_th">操作</th>
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
            <div id='create_route'><img class="route_img"src="../web_image/creat_rout.png"></img></div>
            <div id="like_spot_map_box"></div>
            <div id="route_text_content">
                <table class="like_route_">
                    <?php $i = 0;foreach($like_data as $data){ ?>
                    <tr>
                        <th>
                            <div class="like_route_icon">
                                <p><?php print $labels[$i];?></p>
                            </div>
                        </th>
                        <th></th>
                        <th><?php print $data['spot_name'];?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>
                            <?php if($i< (sizeof($like_data)-1)){ ?>
                            <div class="like_page_circle"></div>
                            <div class="like_page_circle"></div>
                            <div class="like_page_circle"></div>
                            <div class="like_page_circle"></div>
                            <?php } ?>
                        </td>
                        <td class="like_space"></td>
                        <td></td>
                        <td class="like_space"></td>
                        <td><img class="like_sport_img"src="<?php print $data['spot_image'];?>"></img></td>
                        <td class="like_space"></td>
                        <td><?php print $data['spot_content'];?></td>
                    </tr>
                    <?php $i++;} ?>
                </table>
            </div>
        </section>
        <!--initMap is not fanction 解決策-->
        <!--<script src="custom-js-google-map.js"></script> -->
        <script>
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var labelIndex = 0;
        var like_spot;
        var map;
        var markers = [];
        function initMap(){
            like_spot = JSON.parse('<?php echo $like_data_json; ?>');

            var map_box = document.getElementById('like_spot_map_box');
            var mapCenter = {
              lat: parseFloat(like_spot[0]['lat']),
              lng: parseFloat(like_spot[0]['lng'])
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
            
            if(like_spot.length>0){
                addMaker();
            }
            document.getElementById('create_route').addEventListener('click',routeCreate,false);
        }
          
        function addMaker(){
            // console.log(like_spot);
            like_spot.forEach(function(value){
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
        
        function routeCreate(){
            clearMarkers();
            var end = like_spot.pop();
            var wapp = [];
            console.log(like_spot.length);
            console.log(like_spot);
            if(like_spot.length > 1){
                for(var i = 1;i<(like_spot.length);i++){
                    var lat = parseFloat(like_spot[i]['lat']);
                    var lng = parseFloat(like_spot[i]['lng']);
                    var a = {location: new google.maps.LatLng(lat,lng)};
                    wapp.push(a);
                }
            }
            // console.log(wapp);
            // console.log(parseFloat(like_spot[0]['lat']));
            // console.log(parseFloat(like_spot[0]['lng']));
            var request = {
                origin: new google.maps.LatLng(parseFloat(like_spot[0]['lat']),parseFloat(like_spot[0]['lng'])), // 出発地
                destination: new google.maps.LatLng(end['lat'],end['lng']), // 目的地
                waypoints: wapp,
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
            
            //text内容表示
            document.getElementById("route_text_content").style.display="block";//显示
        }
        
        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
              markers[i].setMap(map);
            }
        }

        function clearMarkers() {
            setMapOnAll(null);
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