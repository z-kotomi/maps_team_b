<?php
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <title>danime_store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="danime.css">
    <style>
            .carousel-control-prev-icon, .carousel-control-next-icon{
                height: 100px;
                width: 100px;
                outline: black;
                background-color: rgba(0, 0, 0, 0.3);
                background-size: 100%, 100%;
                border-radius: 50%;
                border: 1px solid black;
            }
    </style>
</head>
<body>
<div class="text-center">
    <div class="container-fluid">
    <header>
            <div class="header_box">
                <a href="search.php">
                    <img class="logo" src="image/danime_logo1.png"></img>
                </a>
        </div>
                <nav class="nav justify-content-end">
                    <a href="#" class="nav-link">お知らせ</a>
                    <a href="#" class="nav-link">さがす</a>
                    <a href="#" class="nav-link">ログイン</a>
                    <a href="#" class="nav-link">無料お試し</a>
                </nav>
                </div>
    </header>
    </div>
    <main>
    <div class="main">
        <br>
        <div class="title">
            <img src="image/danime_title.jpg" class="title_logo">
        </div>
        <article>
            <p class="main_comment">
                今やすっかり有名になった「聖地巡礼」。アニメの舞台（背景）になった場所を実際に訪れる楽しみ方だ。過去にもそうした楽しみ方をする人はいたが、より定番化したのはデジカメとSNSの普及以降とされている。
                実写映画やドラマにもロケ地をめぐる観光の楽しみ方はあるが、アニメがそれとちがうのは、元が絵だという点。絵と現実がちがうからこそ、行ってみてはじめて背景のリアリティがわかり、そこにいるかもしれないキャラクターたちの息吹を想像する楽しみが出てくる。
                アニメストアではさまざまな「聖地巡礼」人気作をピックアップ。
                そしてそんな聖地巡礼者におすすめなのが「聖地巡礼MAP」だ。アニメや地域名を検索することで以下のようなアニメの聖地を地図で見ることが出来る。またスポットを登録すればルート検索もできるという、聖地巡礼の必須アイテムといえるアプリである。アニメを視聴して気になったら、ぜひ聖地を巡礼してみよう！！
            </p>
        </article>
        <div class="spot">
            <div class="spot1">
        <article>
            <h3>君の名は</h3>
            <div class="spot1_1">
                <img src="image/business3.JPG" class="spot1_image1">
                <img src="image/spot3.JPG" class="spot1_image1">
            </div>
            <div class="spot1_2">
                <img src="image/business7.JPG" class="spot1_image2">
                <img src="image/spot7.JPG" class="spot1_image2">
            </div>
            <h3>あらすじ</h3>
            <p class="epilog">
                東京に憧れる田舎暮らしの宮水三葉と東京の街で父と暮らす高校生の立花瀧。出会ったこともない２人がある日夢の中でお互いの身体が入れ替わっていることに気付く。戸惑いながらもお互いの生活を体験する２人、しかし、ある日を境にその入れ替わりは無くなってしまう…。
            </p>
        </article>
            </div>
            <div class="spot2">
        <article>
            <h3>日常</h3>
            <div class="spot2_1">
                <img src="image/business149.jpg" class="spot2_image1">
                <img src="image/spot149.jpg" class="spot2_image1">
            </div>
            <div class="spot2_2">
                <img src="image/business144.jpg" class="spot2_image2">
                <img src="image/spot144.jpg" class="spot2_image2">
            </div>
            <h3>あらすじ</h3>
            <p class="epilog">
                時定高校を中心とした不条理な「日常」を題材にしたシュールな作風の漫画で、登場人物の多くが非常に個性的、かつ変わった言動を繰り返し、奇想天外な出来事の続発に翻弄されていく。
            </p>
        </article>
            </div>
        </div>
        
        <div id="cl" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#cl" data-slide-to="0" class="active"></li>
                <li data-target="#cl" data-slide-to="1"></li>
                <li data-target="#cl" data-slide-to="2"></li>
                <li data-target="#cl" data-slide-to="3"></li>
                <li data-target="#cl" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <h1>
                    地図で聖地をすぐに調べられる！<br>
                    多様な検索・豊富な詳細情報
                    </h1>
                    <div class="guide_image">
                    <img src="image/map.jpg" class="guide">
                    </div>
                </div>
                <div class="carousel-item">
                    <h1>
                    また会員登録するともっと便利な機能が使える！！
                    </h1>
                    <h2>
                    ルート検索
                    </h2>
                    <div class="guide_image">
                    <img src="image/root.png" class="guide">
                    </div>
                    </div>
                <div class="carousel-item">
                    <h2>
                    口コミ投稿機能
                    </h2>
                    <div class="guide_image">
                    <img src="image/comment.png" class="guide">
                    </div>
                </div>
                <div class="carousel-item">
                    <h2>
                    スポット追加機能
                    </h2>
                    <div class="guide_image">
                    <img src="image/add_map.png" class="guide">
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#cl" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#cl" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
        
        
        
       
        
        
        
        
        <br>
        <br>
        <h3>↓このアプリでもっと聖地巡礼を楽しもう！！↓</h3>
        <form action = "search.php" method="post">
            <div class="access_image">
            <input type ="submit" class="access" value="聖地巡礼マップはこちら">
            </div>
        </form>
        <br>
        <br>
    </div>
    </main>
    <div class="container-fluid">
    <footer>
            <section class="foot_all">
                <p style="text-align:center"><a class="foot_link" href="question.php">お問い合わせ</a></p>
                <p style="text-align:center;color:black;font-size:10px"><small>Copyright &copy; B-Team All Rights Reserved.</small></p>
            </section>
    </footer>
    </div>
</div>
<!-- 以下にBootstrap用のJavaScriptを記述します -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
  </body>
</html>