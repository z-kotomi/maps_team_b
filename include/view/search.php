<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>B-team</title>
        <link rel="stylesheet" href="../css/main_style.css" type="text/css" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
                <div class="header_menu header_spe"><a class="header_link" href="like.php">ルート探索</a></div>
                <div class="header_menu header_spe"><a class="header_link" href="main.php">聖地一覧</a></div>
            </div>
        </header>
        <section class="content">
            <!--ここに追加-->
            <div id="serch">
                <div class="search_key">
                    <form method="post" action="search.php" class="search_container">
                        <input type="text" name="key_word" placeholder="アニメ名を入力してください">
                        <input type="submit" name="submit" value="&#xf002">
                    </form>
                        <div id="search_list"><?php print entity_str($result_message); ?>
                            <?php foreach($result_list as $result) { ?>
                            <ul>
                                <li>
                                <a href="map.php?anime_id=<?php echo entity_str($result['anime_id']); ?>">
                                <?php echo entity_str($result['anime_name']); ?>
                                </a>
                                </li>
                            </ul>
                            <?php } ?>
                        </div>
                </div>
                <div class="search_area search_key">
                    <form method="POST" action="map_area.php" class="search_container">
                        <input type="text" name="area" placeholder="地名を入力してください">
                        <input type="submit" name="submit" value="&#xf002">
                </div>
            </div>
            <div id="anime_list">
<?php           foreach($animes as $anime){ ?>
                <span><?php print '・' . entity_str($anime['anime_name']) ;?></span>
<?php           } ?>
            </div>
            <div id="service">
                <h1 id="service_title">ガイドライン</h1>
                <div class="service-box">
                    <h2 class="service_name">聖地一覧</h2>
                    <div class="service_content">
                        <img class="service_img" src="../web_image/listicon.png"></img>
                        <h2 class="service_detail">聖地スポットを一覧で表示し、それぞれのスポットの詳細を見ることができます。さらにスポット追加機能も搭載。</h3>
                    </div>
                </div>
                <p class="service_border"></p>
                <div class="service-box">
                    <h2 class="service_name">口コミ</h2>
                    <div class="service_content">
                        <img class="service_img" src="../web_image/commenticon.png"></img>
                        <h2 class="service_detail">スポット詳細から口コミを登録することができます。<br>みんなで情報を共有しましょう</h3>
                    </div>
                </div>
                <p class="service_border"></p>
                <div class="service-box">
                    <h2 class="service_name">ルート探索</h2>
                    <div class="service_content">
                        <img class="service_img" src="../web_image/routemarkericon.png"></img>
                        <h2 class="service_detail">好きな聖地スポットを複数登録すれば、そのルートを調べることができます。</h3>
                    </div>
                </div>
                <p class="service_border"></p>
            </div>
        </section>
        <footer>
            <section class="foot_all">
                <p style="text-align:center"><a class="foot_link" href="question.php">お問い合わせ</a></p>
                <p class="footer_img"><img src="../web_image/team_logo.png"></img></p>
                <p style="text-align:center;color:black;font-size:10px"><small>Copyright &copy; B-Team All Rights Reserved.</small></p>
            </section>
        </footer>
    </body>
    
</html>