<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>view example</title>
        <link rel="stylesheet" href="../css/main_style.css" type="text/css" />
    </head>
    <body>
        <header>
            <div class="header_box">
                <a href="">
                    <img class="logo" src="../web_image/logo.png"></img>
                </a>
                <div class="header_nemu"><a class="header_link" href="">Menu</a></div>
                <div class="header_nemu header_spe"><a class="header_link" href="">気になる</a></div>
                <div class="header_nemu"><a class="header_link" href="">TOP</a></div>
            </div>
        </header>
        <section class="content">
            <!--ここに追加-->
            <div class="search_image">
            <div class="search_key">
                <p>聖地のキーワードを入力してください</p>
                <form method="post" action="search.php" class="search_keyword">
                    <input type="text" name="key_word">
                    <input type="submit" name="submit" value="送信">
                </form>
                    <p><?php print entity_str($result_message); ?></p>
                    <?php foreach($result_list as $result) { ?>
                    <ol>
                        <li>
                        <a href="maps.php?anime_id=<?php echo entity_str($result['anime_id']); ?>">
                        <?php echo entity_str($result['anime_name']); ?>
                        </a>
                        </li>
                    </ol>
                    <?php } ?>
            </div>
            </div>

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