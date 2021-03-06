    <?php
    require_once 'DbManager.php';       //getDb関数の有効化、データーベースの接続メソッドあり
    require_once 'Encode.php';          //e関数の有効化、文字コードなど
    ?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>ジャンル</title>
</head>
<body>


    <!-- ナビゲーションバー -->
  <header id="header" role="banner">
    <nav class="navbar navbar-expand navbar-light bg-primary pt-0 pb-0 mb-5" >
      <a class="navbar-brand" href="#">Feasy</a>
  </nav>
  </header>
   <!---------------------------------------ここまでナビゲーションバー --------------------------------------------->


<!-- cardを横並びにするためのclass -->
<div class="container">
<div class="row row-cols-1 row-cols-md-3">
  
  
   <?php
   //本来は$genredata  = mysql_real_escape_string($_POST['genre']);のようにエスケープ処理をすること
   //押したジャンルのボタンを取得して$genredataに代入
    $genredata = $_POST['genre'];

   try {
     //DbManager.phpのメソッドでデータベース接続
     $db = getDb();
     //SELECT文の実行、WHEREで押したボタンのジャンルを選別
     $stt = $db->prepare("SELECT * FROM shop WHERE shop_genre = '$genredata'");
     $stt->execute();
     //SELECT結果を$rowにセットし、while文でループ
     while($row = $stt->fetch(PDO::FETCH_ASSOC)) {
   ?>

    <!-- ジャンル検索後のcardを表示 -->
     <div class="col mb-4">
         <div class="card h-100">
         <img src=<?=e($row['shop_images'])?> class="card-img-top" alt="...">
         <div class="card-body">
             <h5 class="card-title"><?=e($row['shop_mei'])?></h5>
             <p class="card-text">所在地：<?=e($row['shop_address'])?></p>
             <p class="card-text"><?=e($row['shop_word'])?></p>
         </div>
         </div>
     </div>

   <?php
     }
    }catch(PDOException $e){
      print "エラーメッセージ：{$e->getMessage()}";
    }
    ?>

    
    </div>
    </div>
   
  
 <script src="js/jquery-3.5.0.slim.min.js"></script>
 <script src="js/bootstrap.bundle.js"></script>
</body>
</html>
