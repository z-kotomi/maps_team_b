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
                <a href="search.php">
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
            <label class="comment_label">
                <span id="add_comment_btn" class="add_comment_title">口コミを投稿</span>
                <input type="checkbox" name="checkbox" id=comment_checkbox>
<?php       if($user_name !== ''){ ?>
                <div id="popup">
                    <label for="comment_checkbox" class="icon-close">×</label>
                    <p>ユーザー名:<?php print h($user_name); ?>さん</p>
                    <form method="post" action="spot_detail.php" name="cnvForm">
                        <label class="comment_form">
                            口コミ内容:<br>
                            <textarea name="comment" rows="3" cols="30" wrap=”hard” onKeyUp="checkNum()" value=""></textarea>
                        </label><br>
                        <input type="hidden" name="spot_id" value="<?php print $spot_id;?>"/>
                        <input type=submit name="submit" value="投稿する">
                    </form>
                </div>
<?php       } ?>
            </label>
<?php     if(count($comments)>0) { ?>
            <p id="comment_caption">口コミ一覧</p>
            <div class="comment_list_scroll"><table id="comment_table">
                <tr>
                    <th>ユーザー名</th>
                    <th><div class="comment_detail">口コミ</div></th>
                    <th>投稿日時</th>
                </tr>
                <?php foreach($comments as $comment) { ?>
                <tr>
                    <td><?php print entity_str($comment['user_name']); ?></td>
                    <td><div class="comment_detail"><?php print entity_str($comment['comment']); ?></div></td>
                    <td><?php print entity_str($comment['created']); ?></td>
                </tr>
                <?php } ?>
            </table></div>
<?php     } ?>
            <div class="return_div"><a  class="return_link" href="main.php">TOPへ戻る</a></div>
        </section>
        <script>
            var user_name;
            function initMap(){
                user_name = '<?php print $user_name;?>';
                // console.log('user name:',user_name);
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
                
                document.getElementById('add_comment_btn').addEventListener('click',login_judge,false)
            }
            function login_judge(){
                if(user_name==''){
                    if (confirm("ログインして下さい！")){
                        window.location='login.php';
                    }else{
                        // document.getElementById('add_comment_btn').style.display="none";
                        window.location.reload();
                    }
                }
            }
            //textareaに入力された文字をリアルタイムでエンティティ化
            function checkNum(){
            	var txt = document.cnvForm.comment.value;
            	var result = "";
            	for (i=0; i<txt.length; i++){
                	if (txt.match(/[<>]/)===null){
                		result =  txt;
                	}else{
                	    result = "";
                    }
                }
            	document.cnvForm.comment.value = result;
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