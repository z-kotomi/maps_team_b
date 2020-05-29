<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>Map画面</title>
        <link rel="stylesheet" href="../css/main_style.css" type="text/css" />
        <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    </head>
    <body>
        <header>
            <div class="header_box">
                <a href="main.php">
                    <img class="logo" src="../web_image/logo.png"></img>
                </a>
                <div class="header_menu">
                <?php if($user_name ==''){ ?>
                <a class="header_link" href="login.php">ログイン</a>
                <?php } else{?>
                <p class="header_user_name_text">ユーザー：<?php print $user_name;?></p>
                <?php } ?>
                </div>
                <?php if($user_name !== ''){ ?>
                <div class="header_menu header_spe"><a class="header_link" href="logout.php">ログアウト</a></div>
                <?php }?>
                <div class="header_menu header_spe"><a class="header_link" href="main.php">聖地一覧</a></div>
                <div class="header_menu header_spe"><a class="header_link" href="like.php">ルート探索</a></div>
                <div class="header_menu header_spe"><a class="header_link" href="search.php">TOP</a></div>
            </div>
        </header>
        <section class="content">
<?php       foreach ($errors as $error) { ?>
            <p><?php print $error; ?></p>
<?php       } ?>
        　　<div id="map_page_map_box"></div>
<?php   if($spots !== []){ ?>
            <h3 id="map_h3"><?php print $area . "聖地リスト" ;?></h3>
            <div class="list_scroll">
                <table class="map_page_table">

<?php           foreach ($spots as $key){ foreach($key as $spot) {;?>
                <tr>
                    <td>
                        <div style="float:right;margin-right:100px;margin-top:20px">
                            <img style="width:50px;height:50px" class="list_like_icon" data-like_spot_id="<?php print entity_str($spot['spot_id']); ?>"  
                            <?php if(in_array($spot['spot_id'],$u_l_data)){ ?>
                                data-like_status="<?php print 'true'?>" 
                                src="../web_image/like_icon_selected.png">
                            <?php }else{ ?>
                                data-like_status="<?php print 'false'?>" 
                                src="../web_image/like_icon_noselected.png">
                            <?php } ?>
                            </img>
                            <img class="map_page_map_btn" data-spotid="<?php print entity_str($spot['spot_id']); ?>" src="../web_image/map_page_map.png"></img>
                        </div>
                        <div style="margin-left:20px">
                            <h2>#<?php print entity_str($spot['location_id']);?>&nbsp;&nbsp;<?php print entity_str($spot['spot_name']); ?></h2>
                        </div>
                        <h3 style="margin-left:50px"><strong><?php print entity_str($spot['spot_content']); ?></strong></h3>
                        <div style="display:flex">
                            <div style="margin-left:100px;margin-right:80px;text-align: center">
                                <p><strong>アニメ中の画面</strong></p>
                                <p>&nbsp;</p>
                                <img class="map_page_img" src="<?php print entity_str($spot['spot_image']); ?>"></img>
                            </div>
                            <div style="text-align: center">
                                <p><strong>現地の画面</strong></p>
                                <p><?php print entity_str($spot['business_name']); ?></p>
                                <img class="map_page_img" src="<?php print entity_str($spot['business_image']); ?>"></img>
                            </div>
                        </div>
                        <div style="margin-left:20px">
                            <p><strong>営業時間：</strong><?php print entity_str($spot['business_time']); ?></p>
                            <p><strong>価格：</strong><?php print entity_str($spot['price']); ?></p>
                            <p><strong>営業内容：</strong><?php print entity_str($spot['business_content']); ?></p>
                        </div>
                    </td>
                </tr>
<?php  } } ?>
            </table></div>
<?php       } ?>
            <div class="return_div"><a class="return_link" href="search.php">検索画面に戻る</a></div>
        </section>
        <script>
            var map_spot;
            var map;
            var markers = [];
            var user_like_sport;
            var user_id;
            var like_sport_insert_result = false;
            function initMap(){
                user_id = '<?php print $user_id;?>';
                map_spot = JSON.parse('<?php echo $spots_json; ?>');
                user_like_sport = JSON.parse('<?php echo $user_like_spot_data_json; ?>');
                // console.log("user_like_",user_like_sport);
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
                markers_monitor();
                list_map_monitor();
                like_icon_monitor();
            }
              
            function addMaker(){
                // console.log(like_spot);
                var i = 0;
                map_spot.forEach(function(value){
                    var lat = parseFloat(value['lat']);
                    var lng = parseFloat(value['lng']);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: {lat:lat,lng:lng},
                        label: map_spot[i]['spot_id']
                    });
                    markers.push(marker);
                    i++;
                });
            }
            function markers_monitor(){
                markers.forEach(function(marker){
                    marker.addListener('click',function(){
                        var contentString = marker_content_creat(marker['label']);
                        var infowindow = new google.maps.InfoWindow({content: contentString});
                        infowindow.open(map, marker); 
                    });
                });
            }
            
            function marker_content_creat(spot_id){
                spot_id = parseInt(spot_id);
                var marker_num;
                for (var i = 0; i < map_spot.length; i++) {
                    if(map_spot[i]['spot_id'] == spot_id){
                        marker_num = i;
                        break;
                    }
                }
                var spot_content = map_spot[marker_num]['spot_content'];
                if(spot_content.length >20){
                    spot_content = spot_content.slice(0,10);
                }
                var contentString = '<h1>'+map_spot[marker_num]['spot_name']+'</h1>'+
                                    '<p><strong>'+map_spot[marker_num]['anime_name']+'</strong></p>'+
                                    '<div class="marker_content_img_div"><img class="marker_content_img"src="'+map_spot[marker_num]['spot_image']+'"></img></div>'+
                                    '<p>'+spot_content+'...</p>'+
                                    '<p><a href="spot_detail.php?spot_id='+map_spot[marker_num]['spot_id']+'">詳細へ</a></p>';
                return contentString
            }
            function list_map_monitor(){
                //spotid
                var map_page_map_btns = Array.from(document.getElementsByClassName('map_page_map_btn'));
                map_page_map_btns.forEach(function(map_page_map_btn){
                    map_page_map_btn.addEventListener('click',function(){
                        console.log("click");
                        var spot_id = map_page_map_btn.dataset.spotid;
                        spot_id = parseInt(spot_id);
                        var marker_num;
                        for (var i = 0; i < map_spot.length; i++) {
                            if(map_spot[i]['spot_id'] == spot_id){
                                marker_num = i;
                                break;
                            }
                        }
                        var lat = parseFloat(map_spot[marker_num]['lat']);
                        var lng = parseFloat(map_spot[marker_num]['lng']);
                        var latLng = new google.maps.LatLng(lat,lng);
                        map.setZoom(16);
                        map.panTo(latLng);
                    });
                });
            }
            function like_icon_monitor(){
                var like_icons = Array.from(document.getElementsByClassName('list_like_icon'));
                like_icons.forEach(function(like_icon){
                    like_icon.addEventListener('click',function(){
                        if(user_id == ''){
                            alert('登録下さい');location.href='login.php';
                        }else{
                            if(like_icon.dataset.like_status =='true'){
                                alert('お気に入りに追加済みです');
                            }else if(like_icon.dataset.like_status =='false'){
                                console.log('add_like')
                                //like_sport DB select 
                                $.ajax({
                                    type:"get",
                                    url:"like_sport_select.php",
                                    data:{ 
                                            user_id:user_id,
                                            spot_id:like_icon.dataset.like_spot_id
                                         },
                                    success:function(select_result){
                                        console.log("result",select_result);
                                        if(select_result == true){
                                            alert('お気に入りに追加済みです');
                                        }else if(select_result == false){
                                            like_sport_insert(like_icon.dataset.like_spot_id);
                                            like_icon.src = '../web_image/like_icon_selected.png';
                                        }
                                    }
                                
                                });
                            }
                        }
                    });
                });
            }
            function like_sport_insert(spot_id){
                $.ajax({
                        type:"get",
                        url:"like_sport_insert.php",
                        data:{ 
                                user_id:user_id,
                                spot_id:spot_id
                             },
                        success:function(result){
                            if(result == 'true'){
                                alert('お気に入りに追加しました');
                                like_sport_insert_result = true;
                            }else{
                                alert('お気に入り失敗'+result);
                            }
                        }
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
