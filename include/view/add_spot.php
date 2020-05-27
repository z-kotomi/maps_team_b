<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>スポット追加</title>
        <link rel="stylesheet" href="../css/main_style.css" type="text/css" />
    </head>
    <body>
        <header>
            <div class="header_box">
                <a href="main.php">
                    <img class="logo" src="../web_image/logo.png"></img>
                </a>
                <div class="header_menu">ユーザー：<?php print $user_name; ?></div>
                <div class="header_menu header_spe"><a class="header_link" href="search.php">検索</a></div>
                <div class="header_menu header_spe"><a class="header_link" href="like.php">気になる</a></div>
                <div class="header_menu header_spe" ><a class="header_link" href="logout.php">ログアウト</a></div>

                <div class="header_menu header_spe"><a class="header_link" href="main.php">TOP</a></div>
            </div>
        </header>
        <section class="content">
            <!--ここに追加-->
            
            <h1>+聖地追加</h1>
            
            <form action="add_spot.php" method="post">
                <p><span class="add_spot_key">位置情報</span></p>
                <label>住所　<input class="add_view_address_text"type="text" name="address" value="<?php print entity_str($address) ?>"></label><br>
                <label>緯度　<input type="text" name="lat" value="<?php print entity_str($lat) ?>"></label><br>
                <label>経度　<input type="text" name="lng" value="<?php print entity_str($lng) ?>"></label>
                <br>
            <!--<form action="add_spot.php" method="post">-->
                <br>
                <p><span class="add_spot_key">アニメ情報を入力してください</span></p>
                <label>アニメの名前　<input type="text" name="anime_name" placeholder="君の名は"></label><br>
                <label>聖地の名前　　<input type="text" name="spot_name" placeholder="四ツ谷駅"></label><br>
                <label>聖地の説明　　<input type="text" name="spot_content" id="add_spot_content" placeholder="瀧と奥寺先輩の待ち合わせスポット"></label><br>
                <br>
                <input type="submit" name="submit" value="送信">
            </form>
            <?php foreach($errors as $error) { ?>
            <p><?php print h($error); ?></p>
            <?php } ?>
            <p><?php print h($message); ?></p>
        </section>
    </body>
    <footer>
        <section class="foot_all">
            <p style="text-align:center"><a class="foot_link" href="question.php">お問い合わせ</a></p>
            <p class="footer_img"><img src="../web_image/team_logo.png"></img></p>
            <p style="text-align:center;color:black;font-size:10px"><small>Copyright &copy; B-Team All Rights Reserved.</small></p>
        </section>
    </footer>
</html>