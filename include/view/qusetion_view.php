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
            <h1>お問い合わせ</h1>
            <img src="../web_image/test.png"></img>
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