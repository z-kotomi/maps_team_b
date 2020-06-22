<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <title>初めてのBootstrap</title>
        
        </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
 
  </head>
  <body>
    <div id="cl" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#cl" data-slide-to="0" class="active"></li>
        <li data-target="#cl" data-slide-to="1"></li>
        <li data-target="#cl" data-slide-to="2"></li>
        <li data-target="#cl" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active"><img src="image01.jpg" class="d-block w-100"></div>
        <div class="carousel-item"><img src="image02.jpg" class="d-block w-100"></div>
        <div class="carousel-item"><img src="image03.jpg" class="d-block w-100"></div>
        <div class="carousel-item"><img src="image04.jpg" class="d-block w-100"></div>
    </div>
    <a class="carousel-control-prev" href="#cl" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#cl" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>
 
    <!-- 以下にBootstrap用のJavaScriptを記述します -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
  </body>
</html>