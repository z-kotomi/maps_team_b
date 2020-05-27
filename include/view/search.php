<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>検索画面</title>
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
                <div class="header_menu header_spe"><a class="header_link" href="search.php">検索</a></div>
                <div class="header_menu header_spe"><a class="header_link" href="like.php">気になる</a></div>
                <div class="header_menu header_spe"><a class="header_link" href="main.php">TOP</a></div>
            </div>
        </header>
        <section class="content">
            <!--ここに追加-->
            <div class="search_key">
                <p>聖地のキーワードを入力してください</p>
                <form method="post" action="search.php">
                    <input type="text" name="key_word">
                    <input type="submit" name="submit" value="送信">
                </form>
                    <p><?php print entity_str($result_message); ?></p>
                    <?php foreach($result_list as $result) { ?>
                    <ol>
                        <li>
                        <a href="map.php?anime_id=<?php echo entity_str($result['anime_id']); ?>">
                        <?php echo entity_str($result['anime_name']); ?>
                        </a>
                        </li>
                    </ol>
                    <?php } ?>
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