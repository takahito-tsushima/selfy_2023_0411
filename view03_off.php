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
$stmt = $pdo->prepare('SELECT * 
FROM register00_photo 
LEFT JOIN register01_on ON register00_photo.lid = register01_on.lid 
LEFT JOIN register03_off ON register00_photo.lid = register03_off.lid 
LEFT JOIN register05_history ON register00_photo.lid = register05_history.lid 
where register00_photo.lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示

$photo_on = '' or 
$photo_off = '' or 
$photo_old = '' or 
$catch_phrase_off = '' or

$name_j = '' or 
$name_e = '' or 
$birth = '' or 
$born = '' or 

$residence = '' or 
$family = '' or 
$hobby = '' or 
$time_weekday = '' or 
$time_weekend = '' or 

$facebook = '' or 
$instagram = '' or 
$twitter = '' or 

$holiday = '' or 
$interest = '' or 
$crazy = '' or 
$love = '' or 
$important = '' or 
$collection = '' or 
$expensive = '' or 
$respect = '' ;



if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {  
        //GETデータ送信リンク作成
        
        $photo_on .= '<img src="./img/' . $result['photo_on'] . '" class="rounded img-fluid" width="200">';        
        $photo_off .= '<img src="./img/' . $result['photo_off'] . '" class="rounded img-fluid" width="300">';
        $photo_old .= '<img src="./img/' . $result['photo_old'] . '" class="rounded img-fluid" width="200">';
        $catch_phrase_off .= $result['catch_phrase_off'];

        $name_j .= $result['name01j'] . '  ' . $result['name02j'];
        $name_e .= $result['name01e'] . '  ' . $result['name02e'];
        $birth .= '生年月： ' . $result['birth_year']. '年 ' . $result['birth_month']. '月';
        $born .= '出身： ' . $result['born_place']. ' / ' . $result['prefecture'] . $result['country'];

        $residence .= '居住エリア： ' .  $result['residence'];
        $family .= '家族： ' .  $result['family'];
        $hobby .= '趣味： ' .  $result['hobby'];
        $time_weekday .= '睡眠時間（平日）： ' .  $result['time_weekday'];
        $time_weekend .= '睡眠時間（週末）： ' .  $result['time_weekend'];    

        $holiday .= $result['holiday'];
        $interest .= $result['interest'];
        $crazy .= $result['crazy'];
        $love .= $result['love'];
        $important .= $result['important'];
        $collection .= $result['collection'];
        $expensive .= $result['expensive'];
        $respect .= $result['respect'];        
        
        $facebook .=  'facebook：<br>' . '<a href=' . $result['facebook'] . '>' . $result['facebook'] . '</a>';
        $instagram .=  'instagram：<br>' . '<a href=' . $result['instagram'] . '>' . $result['instagram'] . '</a>';
        $twitter .=  'twitter：<br>' . '<a href=' . $result['twitter'] . '>' . $result['twitter'] . '</a>';



    }
}



//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT 
register01_on.date as date01,
register03_off.date as date03,
register05_history.date as date05

FROM register00_photo 
LEFT JOIN register01_on ON register00_photo.lid = register01_on.lid 
LEFT JOIN register03_off ON register00_photo.lid = register03_off.lid 
LEFT JOIN register05_history ON register00_photo.lid = register05_history.lid 
where register00_photo.lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();


//３．データ表示

$date01 = '' or 
$date03 = '' or 
$date05 = '' ; 


if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {  
        //GETデータ送信リンク作成

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

    <title>My OFF / オフの私</title>

</head>

<body>


<main class="container">

<header class="pb-3 mb-4 border-bottom">
    <span class="fs-4">My OFF / オフの私</span>
</header>


<!-- 氏名など -->
  <div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-4">
      <div class="col-10 col-sm-8 col-lg-4 justify-content-center">
        <?= $photo_off ?>
      </div>
      <div class="col-lg-8">
        <h1 class="display-5 fw-bold lh-1 mb-5"><?= $catch_phrase_off ?></h1>
        <h2><?= $name_j ?></h2>
        <p class="lead mb-5"><?= $name_e ?></p>
        <p class="lead"><?= $birth ?></p>
        <p class="lead mb-5"><?= $born ?></p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <button type="button" class="btn btn-primary px-4 me-md-2" onclick="location.href='edit03_off.php'">Edit / 編集</button>
          <button type="button" class="btn btn-outline-secondary px-4" onclick="location.href='top.php'">TOP / トップへ &raquo;</button>
        </div>
      </div>
    </div>
  </div>


<!-- 基本情報 -->  
  <div class="p-4 row g-5">
    <div class="col-md-8">
      <h3 class="pb-4 mb-4 border-bottom">基本情報</h3>

    <!-- 私のプライベート -->  
      <article class="blog-post py-4">
        <h5 class="blog-post-title mb-1">■私のプライベート</h5>
        <p >My Private Information</p>

        <div class="py-4">
        <p class="lead fw-bold mb-4"><?= $residence ?></p>
        <h2><?= $family ?></h2>
        <h2 class="mb-5"><?= $hobby ?></h2>
        <p class="mb-1"><?= $time_weekday ?></p>
        <p class="mb-1"><?= $time_weekend ?></p>
        </div>
    </article>

    <!-- 私のお気に入り -->  
      <article class="blog-post py-4">
        <h5 class="blog-post-title mb-1">■私のお気に入り</h5>
        <p >My Favorite</p>
   
        <div class="py-4 fs-bld-4">
        <h4>休日の過ごし方</h4>
        <p class="lead mb-5"><?= $holiday ?></p>
        <h4>興味関心のあること</h4>
        <p class="lead mb-5"><?= $interest ?></p>
        <h4>ハマっているもの</h4>
        <p class="lead mb-5"><?= $crazy ?></p>
        <h4>最近好きになったもの</h4>
        <p class="lead mb-5"><?= $love ?></p>
        <h4>大切にしているもの</h4>
        <p class="lead mb-5"><?= $important ?></p>
        <h4>自慢のコレクション</h4>
        <p class="lead mb-5"><?= $collection ?></p>
        <h4>一番高価な買い物</h4>
        <p class="lead mb-5"><?= $expensive ?></v>
        <h4>尊敬する人や憧れの人</h4>
        <p class="lead"><?= $respect ?></p>
        </div>
    </article>


    </div>


    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">

    <!-- SNSリンク -->
        <div class="px-4 py-4 bg-light rounded">
          <p class="mb-3"><?= $facebook ?></p>
          <p class="mb-3"><?= $instagram ?></p>
          <p class="mb-3"><?= $twitter ?></p>
        </div>

        <!-- <div class="p-4">
          <h4 class="fst-italic">Elsewhere</h4>
          <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
          </ol>
        </div> -->


      </div>
    </div>
  </div>



<!-- オフとヒストリーへのリンク -->
<div class="row mb-2 mt-5">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">My ON</strong>
          <h3 class="mb-1">オンの私</h3>
          <div class="mb-1 text-muted"><?= $date01 ?></div>
          <!-- <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p> -->
          <a href="view01_on.php" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-flex align-items-center p-3">
        <?= $photo_on ?>
        </div>
      </div>
    </div>
 
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">My History</strong>
          <h3 class="mb-1">私のヒストリー</h3>
          <div class="mb-1 text-muted"><?= $date05 ?></div>
          <!-- <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p> -->
          <a href="view05_history.php" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-flex align-items-center p-3">
        <?= $photo_old ?>
        </div>
      </div>
    </div>

  </div>


</main>


<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>