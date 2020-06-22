<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <title>初めてのBootstrap</title>
        <style>
            
            .name{
                width:440px;
            }
            .mail{
                width:440px;
            }
            .content{
                width:440px;
                height:100px;
            }
        </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
 
  </head>
  <body>
    <button class="btn btn-info" data-toggle="modal" data-target="#modal1">お問い合わせ</button>
 
<div class="modal fade" id="modal1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class=“modal-title”>お問い合わせ</h3>
                <button class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="name_area">お名前<br>
                    <input type="text" name="user_name" class="name"></div>
                    <div class="mail_area">メールアドレス<br>
                    <input type="email" name="mail" class="mail">
                    <div class="content_area">お問い合わせ内容<br>
                    <input type="text" name="user_name" class="content"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">クリア</button>
                <button class="btn btn-primary" data-dismiss="modal">送信</button>
            </div>
        </div>
    </div>
</div>
 
    <!-- 以下にBootstrap用のJavaScriptを記述します -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
  </body>
</html>