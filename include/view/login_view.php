<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログインページ</title>
        <link rel="stylesheet" href="../css/main_style.css" type="text/css" />
    </head>
    <body>
        <header>
            <div class="header_box">
                <a href="main.php">
                    <img class="logo" src="../web_image/logo.png"></img>
                    <div class="header_menu"><a class="header_link" href="main.php">TOP</a></div>
                </a>
            </div>
        </header>
        <section class="content">
            <div class="login_content">
              <form method="post" action="login_process.php">
                <div><input type="text" name="user_name" placeholder="ユーザー名"></div>
                <div><input type="password" name="password" placeholder="パスワード">
                <div><input type="submit" value="ログイン">
              </form>
              <?php if(count($error)>0){ ?>
              <?php foreach($error as $value){ ?>
              <p class="red"><?php print $value;} ?></p>
              <?php } ?>
              <div class="account_create">
                <a href="register.php">ユーザーの新規作成</a>
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