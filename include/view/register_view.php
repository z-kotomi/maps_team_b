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
                <a href="">
                    <img class="logo" src="../web_image/logo.png"></img>
                </a>
            </div>
        </header>
        <section class="content">
            <div class="login_content">
                <?php if(count($error)>0){ ?>
                <?php foreach($error as $value){ ?>
                <p class="red"><?php print $value;} ?></p>
                <?php } ?>
                <?php if($register){ ?>
                <p class="blue">アカウント作成を完了しました</p>
                <?php } ?>
                <form method="post">
                  <p>※ユーザー名及びパスワード６文字以上、１５文字以下の半角英数字入力下さい</p>
                  <div>ユーザー名：<input type="text" name="new_user_name" placeholder="ユーザー名"></div>
                  <div>パスワード：<input type="password" name="new_password" placeholder="パスワード">
                  <div><input type="submit" value="ユーザーを新規作成する">
                </form>
                <div class="account_create">
                    <a href="login.php">ログインページに移動する</a>
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