<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>B-team</title>
        <link rel="stylesheet" href="../css/main_style.css" type="text/css" />
    </head>
    <body>
        <header>
            <div class="header_box">
                <a href="main.php">
                    <img class="logo" src="../web_image/logo.png"></img>
                </a>
                <div class="header_menu">
                <?php if($user_name ==''){ ?>
                <a class="header_link" href="login.php">登録</a>
                <?php } else{?>
                <p class="header_user_name_text">ユーザー：<?php print $user_name;?></p>
                <?php } ?>
                </div>
                <?php if($user_name !== ''){ ?>
                <div class="header_menu header_spe"><a class="header_link" href="logout.php">ログアウト</a></div>
                <?php }?>
                <div class="header_menu header_spe"><a class="header_link" href="main.php">聖地一覧</a></div>
                <div class="header_menu header_spe"><a class="header_link" href="like.php">気になる</a></div>
                <div class="header_menu header_spe"><a class="header_link" href="search.php">TOP</a></div>
            </div>
        </header>
        <section class="main_content">
            <!--ここに追加-->
            <!--<img src="../web_image/test.png"></img>-->
            <div id="main_map_box"></div>
            <div class="main_list_section">
                <ul class="main_list">
                    <?php $i=1;foreach($spots_data as $value){ ?>
                    <li><?php print $i;?>&nbsp;&nbsp;<?php print $value['anime_name'];?></li>
                    <li class="main_li_no_spot">
                        <p class="spot_name" data-spotnum="<?php print $i;?>">
                        <?php print $value['spot_name'];?></p>
                    </li>
                    <li class="main_li_no_spot">&nbsp;&nbsp;</li>
                    <?php $i++;} ?>
                </ul>
            </div>
        </section>
        <div id="main" style="position:absolute;">
            <div style="text-align:right;cursor:pointer;" id="close">閉める</div>
            <img src="../web_image/important.png" border="0" width="150" height="150" />
        </div>
        <footer>
            <section class="foot_all">
                <p style="text-align:center"><a class="foot_link" href="question.php">お問い合わせ</a></p>
                <p class="footer_img"><img src="../web_image/team_logo.png"></img></p>
                <p style="text-align:center;color:black;font-size:10px"><small>Copyright &copy; B-Team All Rights Reserved.</small></p>
            </section>
        </footer>
        <script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
        <script src="../JS/main_js.js"></script>
        <script>
            var spot_data;
            var map;
            var map_box;
            var markers = [];
            var i = 1;
            // var service;
            function initMap(){
                spot_data = JSON.parse('<?php print $spots_data_json; ?>');
    
                map_box = document.getElementById('main_map_box');
                var mapCenter = {
                  lat: 35.6964467,
                  lng: 139.7046101
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
                
                if(spot_data.length>0){
                    addMaker();
                }
                // document.getElementById('create_route').addEventListener('click',routeCreate,false);
                markers_monitor();
                spot_name_monitor();
                add_spot_monitor();
            }
            function addMaker(){
                // console.log(like_spot);
                spot_data.forEach(function(value){
                    var lat = parseFloat(value['lat']);
                    var lng = parseFloat(value['lng']);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: {lat:lat,lng:lng},
                        label: i.toString()
                    });
                    markers.push(marker);
                    i++;
                });
            }
            
            function spot_name_monitor(){
                        // ボタンを取得し配列に変換。
                var spot_name_ps = Array.from(document.getElementsByClassName('spot_name'));
                spot_name_ps.forEach(function(spot_name_p){
                    spot_name_p.addEventListener('click',function(){
                        console.log("click");
                        var spot_num = spot_name_p.dataset.spotnum;
                        spot_num = parseInt(spot_num);
                        spot_num = spot_num - 1;
                        console.log("aaa",spot_name_p.dataset);
                        console.log("番号",spot_num);
                        console.log(spot_data);
                        var lat = parseFloat(spot_data[spot_num]['lat']);
                        var lng = parseFloat(spot_data[spot_num]['lng']);
                        var latLng = new google.maps.LatLng(lat,lng);
                        map.setZoom(16);
                        map.panTo(latLng);
                    });
                });
            }
            
            function markers_monitor(){
                markers.forEach(function(marker){
                    marker.addListener('click',function(){
                        console.log(marker);
                        var contentString = marker_content_creat(marker['label']);
                        var infowindow = new google.maps.InfoWindow({content: contentString});
                        infowindow.open(map, marker); 
                    });
                });
            }
            
            function marker_content_creat(marker_num){
                marker_num = parseInt(marker_num);
                marker_num = marker_num - 1;
                var spot_content = spot_data[marker_num]['spot_content'];
                if(spot_content.length >20){
                    spot_content = spot_content.slice(0,10);
                }
                var contentString = '<h1>'+spot_data[marker_num]['spot_name']+'</h1>'+
                                    '<p><strong>'+spot_data[marker_num]['anime_name']+'</strong></p>'+
                                    '<div class="marker_content_img_div"><img class="marker_content_img"src="'+spot_data[marker_num]['spot_image']+'"></img></div>'+
                                    '<p>'+spot_content+'...</p>'+
                                    '<p><a href="spot_detail.php?spot_id='+spot_data[marker_num]['spot_id']+'">詳細へ</a></p>';
                return contentString
            }
            
            function add_spot_monitor(){
                map.addListener('dblclick', function(mapsMouseEvent) {
                    // Close the current InfoWindow.
                    //infoWindow.close();
                    console.log("abs",mapsMouseEvent.latLng.toString());
                    console.log("aaa",mapsMouseEvent)
                    //場所検索
                    // var request = {
                    //               locationBias: {lat: 37.402105, lng: -122.081974},
                    //               fields: ['name', 'geometry','formatted_address'],
                    //             }
                    // service = new google.maps.places.PlacesService(map);
                    // service.findPlaceFromQuery(request,function(results, status){
                    //   if(status == google.maps.places.PlacesServiceStatus.OK){
                    //       console.log("name",results[0].formatted_address);
                    //   } 
                    // });
                    var latlng = mapsMouseEvent.latLng;
                    var add_address; 
                    // console.log("hello",latlng.lat());
                    geocoder = new google.maps.Geocoder();
                    //根据经纬度获取地址信息
                    geocoder.geocode({'latLng': latlng}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            //console.log("name",results[0].formatted_address);
                            add_address = results[0].formatted_address;
                            
                            console.log("test",add_address);
                            var contentString = '<h1>ここにアニメスポットを追加したいですか</h1>'+
                                              '<p>追加したい場所：'+ add_address +'</p>'+
                                              '<form method="post" action="add_spot.php" class="main_map_addspot">'+
                                                    '<input type="hidden" name="new_address" value="'+ add_address　+'"/>'+
                                                    '<input type="hidden" name="new_lat" value="'+ latlng.lat() +'"/>'+
                                                    '<input type="hidden" name="new_lng" value="'+ latlng.lng()+'"/>'+
                                                    '<input type="submit" value="追加"/>'+
                                              '</form>';
                            infoWindow = new google.maps.InfoWindow({content: contentString,position: mapsMouseEvent.latLng});
                            //infoWindow.setContent(mapsMouseEvent.latLng.toString());
                            infoWindow.open(map);
                        }
                    });
                });
            }
            $(function() {
                $("#close").click(function() {
                $("#main").hide();
                });
            });
            var ad1 = new AdMove("main", true);
            ad1.Run();
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=<?php echo API_KEY; ?>&libraries=places&callback=initMap"></script>
    </body>
</html>