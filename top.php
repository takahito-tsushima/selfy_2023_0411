<?php

// SESSION開始！！
session_start();
// 関数群の読み込み
require_once('funcs.php');
// ログインチェック処理！
loginCheck();


$lid = $_SESSION['lid'];

// 関数ファイルでreturnで外に出した$pdoを使う
$pdo = db_conn();



//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM record_exchange 
LEFT JOIN register00_photo ON record_exchange.object = register00_photo.lid 
LEFT JOIN register01_on ON record_exchange.object = register01_on.lid 
where record_exchange.lid = :lid ORDER BY record_exchange.date DESC'); //新着順に表示
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示

$view="";   

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    for($i = 0; $i < 3; $i++){
        $result = $stmt->fetch();

        if(empty($result)){
            break;
        }else{

            $view .= '<div class="col-lg-4  p-4">';
            $view .= '<p class="text-center">'. $result['ex_date'] . '</p>';
            $view .= '<img class="rounded-circle rounded mx-auto d-block" src="./img/' . $result['photo_on'] . '" width="200" height="200">';
            $view .= '<p class="lead text-center pt-3">' . $result['catch_phrase_on'] . '</p>';
            $view .= '<h3 class="fw-bold text-center">' . $result['name01j'] . '  ' . $result['name02j'] . '</h3>';
            $view .= '<p class="fw-normal text-center">' . $result['name01e'] . '  ' . $result['name02e'] . '</p>';
            $view .= '</div><!-- /.col-lg-4 -->';   

    }
    }

}



//２．データ登録SQL作成

$stmt = $pdo->prepare('SELECT * FROM record_exchange where record_exchange.lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {

    $result = $stmt->rowCount();
    $count = '<p class="text-center">< Total: ' . $result . ' ></p><br>';

}



//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT 
register01_on.id as id,
register01_on.date as date01,
register03_off.date as date03,
register05_history.date as date05,
register00_photo.photo_on,
register00_photo.photo_off,
register00_photo.photo_old

FROM register00_photo 
LEFT JOIN register01_on ON register00_photo.lid = register01_on.lid 
LEFT JOIN register03_off ON register00_photo.lid = register03_off.lid 
LEFT JOIN register05_history ON register00_photo.lid = register05_history.lid 
where register00_photo.lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();


//３．データ表示

$id = '' or 
$photo_on = '' or 
$photo_off = '' or 
$photo_old = '' or 
$date01 = '' or 
$date03 = '' or 
$date05 = '' ; 


if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {  
        //GETデータ送信リンク作成

        $id .= $result['id'];        
        $photo_on .= '<img class="rounded mx-auto d-block mt-4" src="./img/' . $result['photo_on'] . '" width="200">';
        $photo_off .= '<img class="rounded mx-auto d-block mt-4" src="./img/' . $result['photo_off'] . '" width="200">';
        $photo_old .= '<img class="rounded mx-auto d-block mt-4" src="./img/' . $result['photo_old'] . '" width="200">';
        $date01 .= $result['date01'];
        $date03 .= $result['date03'];
        $date05 .= $result['date05'];



    }
}


?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">

    <title>【 Selfy 】トップページ</title>



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>




</head>
<body>


<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted mb-0">商談の「最初の5分」を創るウェブアプリ。</p>
          <p class="text-muted mb-0">人間関係のゼロ→イチ構築をサポートし、成果を求める営業マンの成約率を向上する！</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
            <!-- <li><a href="#" class="text-white">Email me</a></li> -->
            <li><?= '<a href="mailto:hogehoge@gmail.com" class="text-white">Email me</a>'; ?></li>
            
        <!-- 画像にハイパーリンクを付けて本文に記述 -->
            
            <!-- ハイパーリンクのみ -->
            <a href='mailto:hogehoge@gmail.com?body=<a href="http://www.selfy.co.jp/accept.php?id=<?= $id ?>">リンク</a>'>Email me</a>
            <!-- 画像のみ -->
            <a href='mailto:hogehoge@gmail.com?body=<img src="http://localhost/gs_code/selfy/screenshot/screenshot_id.png">'>Email me</a>


            <!-- <a href='mailto:hogehoge@gmail.com?body=<a href="http://www.selfy.co.jp/accept.php?id=<?= $id ?>">img src="./img/screenshot_id.png"</a>'>Email me</a> -->

            <!-- <a href='mailto:hogehoge@gmail.com?body=http://localhost/gs_code/selfy/screenshot/screenshot_id'>Email me</a> -->

            <!-- <img src="cid:http://localhost/gs_code/selfy/screenshot/screenshot_id.png"> Email me</a> -->

            <!-- <a href='mailto:hogehoge@gmail.com?body=<a href=\"http://www.selfy.co.jp/accept.php?id=<?= $id ?>\">テストだよ</a>class="text-white"'>Email me</a> -->
<!-- img src="./img/screenshot_id.png" class="rounded img-fluid" width="200" -->

          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="top.php" class="navbar-brand d-flex align-items-center">
        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg> -->
        <h1 class="display-5 fw-bold text-white">Selfy</h1>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>




  <!-- <div class="container-fluid"> -->

  <div class="b-example-divider"></div>

    <div class="py-5">

        <div><h1 class="fw-bold text-center">New Rapport</h1></div>
        <div><h2 class="lead fw-bold text-center">新たな関係</h2></div>
        
        <div class="pt-3"><?= $count ?></div>  

        <main class="container">

            <div class="row">
                <?= $view ?>
            </div><!-- /.row -->

        </main>

        <div class="text-center">
          <a class="btn btn-secondary col-md-3 rounded mx-auto" href="profile_list.php">View all / さらに見る &raquo;</a>
        </div>

    </div>

    <div class="b-example-divider"></div>



    <div class="album py-5 bg-light">

        <div><h1 class="fw-bold text-center">My Profile</h1></div>
        <div><h2 class="lead fw-bold text-center">私のプロフ</h2></div>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <div class="col p-4">
          <div class="card shadow-sm">
            <div><?= $photo_on ?></div>

            <div class="card-body"> 
              <h3 class="card-text fw-bold text-center">My ON</h3>
              <p class="card-text fw-normal text-center">オンの私</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a class="btn btn-sm btn-secondary" href="view01_on.php">View</a>
                  <a class="btn btn-sm btn-outline-secondary" href="edit01_on.php">Edit</a>
                  <a class="btn btn-sm btn-outline-secondary" href="edit00_photo01.php">Photo</a>
                </div>
                <small class="text-muted"><?= $date01 ?></small>
              </div>
            </div>
          </div>
        </div>

        <div class="col p-4">
          <div class="card shadow-sm">
          <div><?= $photo_off ?></div>

            <div class="card-body"> 
              <h3 class="card-text fw-bold text-center">My OFF</h3>
              <p class="card-text fw-normal text-center">オフの私</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a class="btn btn-sm btn-secondary" href="view03_off.php">View</a>
                  <a class="btn btn-sm btn-outline-secondary" href="edit03_off.php">Edit</a>
                  <a class="btn btn-sm btn-outline-secondary" href="edit00_photo03.php">Photo</a>
                </div>
                <small class="text-muted"><?= $date03 ?></small>
              </div>
            </div>
          </div>
        </div>

        <div class="col p-4">
          <div class="card shadow-sm">
          <div><?= $photo_old ?></div>

            <div class="card-body"> 
              <h3 class="card-text fw-bold text-center">My History</h3>
              <p class="card-text fw-normal text-center">私のヒストリー</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a class="btn btn-sm btn-secondary" href="view05_history.php">View</a>
                  <a class="btn btn-sm btn-outline-secondary" href="edit05_history.php">Edit</a>
                  <a class="btn btn-sm btn-outline-secondary" href="edit00_photo05.php">Photo</a>
                </div>
                <small class="text-muted"><?= $date05 ?></small>
              </div>
            </div>
          </div>
        </div>

      </div>

        <div class="text-center pt-5"><a class="btn btn-primary col-md-3 rounded mx-auto" href="send.php">Send / プロフィールを送信する &raquo;</a></div>

    </div>
    <!-- </div> -->


        <!-- <p>私の写真</p>
        <a href="view00_photo.php">表示</a>
        <a href="edit00_photo.php">作成・編集</a>

        <p>オンの私 / ON</p>
        <a href="view01_on.php">表示</a>
        <a href="edit01_on.php">作成・編集</a>

        <p>私のトリセツ</p>
        <a href="view02_torisetsu.php">表示</a>
        <a href="edit02_torisetsu.php">作成・編集</a>

        <p>オフの私 / OFF</p>
        <a href="view03_off.php">表示</a>
        <a href="edit03_off.php">作成・編集</a>

        <p>私の素顔図鑑</p>
        <a href="view04_truth.php">表示</a>
        <a href="edit04_truth.php">作成・編集</a>

        <p>私のヒストリー</p>
        <a href="view05_history.php">表示</a>
        <a href="edit05_history.php">作成・編集</a> -->


  <div class="b-example-divider"></div>

    <div class="bg-dark text-secondary px-4 py-5 text-center">
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a class="btn btn-outline-light col-md-2 px-4" href="logout_act.php">Log out</a>
      </div>
      <div class="pt-5">
        <h1 class="display-5 fw-bold text-white">Selfy</h1>
        <div class="col-lg-6 pt-3 mx-auto">
        <p class="fs-5">Copyright © 2023 Selfy Co., Ltd. All Rights Reserved.</p>
      </div>
      </div>
    </div>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>