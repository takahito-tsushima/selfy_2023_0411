<?php

// SESSION開始！！
session_start();
// 関数群の読み込み
require_once('funcs.php');
// ログインチェック処理！
loginCheck();


$lid = $_SESSION['lid'];
$id = $_GET['id'];

// 関数ファイルでreturnで外に出した$pdoを使う
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM register01_on JOIN register00_photo USING(lid) where register01_on.id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


//３．データ表示

$photo_on = '' or 
$photo_off = '' or 
$photo_old = '' or 
$catch_phrase_on = '' or

$name_j = '' or 
$name_e = '' or 
$birth = '' or 
$born = '' or 

$occupation = '' or 
$affiliation = '' or 
$division = '' or 
$start = '' or 

$postal = '' or 
$address01 = '' or 
$address02 = '' or 
$phone = '' or 
$fax = '' or 
$url = '' or 
$email = '' or 
$mobile = '' or 

$univ = '' or 
$univ_major = '' or 
$univ_period = '' or 
$univ_detail = '' or 

$hs = '' or 
$hs_major = '' or 
$hs_period = '' or 
$hs_detail = '' or 

$grad = '' or 
$grad_major = '' or 
$grad_period = '' or 
$grad_detail = '' or 

$career01 = '' or 
$division01 = '' or 
$career01_period = '' or 
$career01_detail = '' or 

$career02 = '' or 
$division02 = '' or 
$career02_period = '' or 
$career02_detail = '' or 

$career03 = '' or 
$division03 = '' or 
$career03_period = '' or 
$career03_detail = '' or 

$motiv01 = '' or 
$motiv02 = '' or 
$motiv03 = '' or 
$episode = '' or 
$episode_detail = '';


if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {  
        //GETデータ送信リンク作成

        $photo_on .= '<img src="./img/' . $result['photo_on'] . '" class="rounded img-fluid" width="300">';        
        $photo_off .= '<img src="./img/' . $result['photo_off'] . '" class="rounded img-fluid" width="200">';
        $photo_old .= '<img src="./img/' . $result['photo_old'] . '" class="rounded img-fluid" width="200">';
        $catch_phrase_on .= $result['catch_phrase_on'];

        $name_j .= $result['name01j'] . '  ' . $result['name02j'];
        $name_e .= $result['name01e'] . '  ' . $result['name02e'];
        $birth .= '生年月： ' . $result['birth_year']. '年 ' . $result['birth_month']. '月';
        $born .= '出身： ' . $result['born_place']. ' / ' . $result['prefecture'] . $result['country'];

        $affiliation .= $result['affiliation'];
        $division .= $result['division'];
        $start .=  '【 ' . $result['start_year']. '年 ' . $result['start_month']. '月' . ' 入社 】';

        $postal .= '〒' . $result['postal'];
        $address01 .= $result['address01'];
        $address02 .= $result['address02'];
        $phone .=  '電話：' . '<a href="tel:' . $result['phone'] . '">' . $result['phone'] . '</a>';
        $fax .=  'FAX：' . '<a href="tel:' . $result['fax'] . '">' . $result['fax'] . '</a>';
        $url .=  'HP：' . '<a href=' . $result['url'] . '>' . $result['url'] . '</a>';
        $email .=  'Email：' . '<a href="mailto:' . $result['email'] . '">' . $result['email'] . '</a>';
        $mobile .=  '携帯： ' . $result['mobile'];

        $univ .= $result['univ'];
        $univ_major .= $result['univ_major'];
        $univ_period .= $result['univ_start_year']. '年' . $result['univ_start_month']. '月～' . $result['univ_end_year']. '年' . $result['univ_end_month']. '月';
        $univ_detail .= $result['univ_detail'];

        $hs .= $result['hs'];
        $hs_major .= $result['hs_major'];
        $hs_period .= $result['hs_start_year']. '年' . $result['hs_start_month']. '月～' . $result['hs_end_year']. '年' . $result['hs_end_month']. '月';
        $hs_detail .= $result['hs_detail'];

        $grad .= $result['grad'];
        $grad_major .= $result['grad_major'];
        $grad_period .= $result['grad_start_year']. '年' . $result['grad_start_month']. '月～' . $result['grad_end_year']. '年' . $result['grad_end_month']. '月';
        $grad_detail .= $result['grad_detail'];

        $career01 .= $result['career01'];
        $division01 .= $result['division01'];
        $career01_period .= $result['career01_start_year']. '年' . $result['career01_start_month']. '月～' . $result['career01_end_year']. '年' . $result['career01_end_month']. '月';
        $career01_detail .= $result['career01_detail'];

        $career02 .= $result['career02'];
        $division02 .= $result['division02'];
        $career02_period .= $result['career02_start_year']. '年' . $result['career02_start_month']. '月～' . $result['career02_end_year']. '年' . $result['career02_end_month']. '月';
        $career02_detail .= $result['career02_detail'];

        $career03 .= $result['career03'];
        $division03 .= $result['division03'];
        $career03_period .= $result['career03_start_year']. '年' . $result['career03_start_month']. '月～' . $result['career03_end_year']. '年' . $result['career03_end_month']. '月';
        $career03_detail .= $result['career03_detail'];

        $motiv01 .= $result['motiv01'];
        $motiv02 .= $result['motiv02'];
        $motiv03 .= $result['motiv03'];

        $episode .=  '【 ' . $result['episode']. ' 】';
        $episode_detail .= $result['episode_detail'];


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



//２．データ登録SQL作成

$stmt2 = $pdo->prepare("SELECT id FROM record_exchange LEFT JOIN register01_on ON record_exchange.lid = register01_on.lid 
where record_exchange.object = :lid and register01_on.id = $id");
$stmt2->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt2->execute();


//３．データ表示
$check= $stmt2->rowCount();
  
if ($check == 0){ 
  $view = '<button type="button" class="btn btn-primary px-4 me-md-2" onclick="location.href=' . '\'exchange.php?id=' .  $id . '\'">Exchange / 交換する</button>';    
}else{
  $view = '';
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

    <title>My ON / オンの私</title>

</head>

<body>

<main class="container">

<header class="pb-3 mb-4 border-bottom">
    <span class="fs-4">My ON / オンの私</span>
</header>


<!-- 氏名など -->
  <div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-4">
      <div class="col-10 col-sm-8 col-lg-4 justify-content-center">
        <?= $photo_on ?>
      </div>
      <div class="col-lg-8">
        <h1 class="display-5 fw-bold lh-1 mb-5"><?= $catch_phrase_on ?></h1>
        <h2><?= $name_j ?></h2>
        <p class="lead mb-5"><?= $name_e ?></p>
        <p class="lead"><?= $birth ?></p>
        <p class="lead mb-5"><?= $born ?></p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <?= $view ?>
          <!-- <button type="button" class="btn btn-primary px-4 me-md-2" onclick="location.href='exchange.php?id=<?= $id ?>'">Exchange / 交換する</button> -->
          <button type="button" class="btn btn-outline-secondary px-4" onclick="location.href='profile_list.php'">Back / 一覧に戻る &raquo;</button>
        </div>
      </div>
    </div>
  </div>
  
<!-- 基本情報 -->  
  <div class="p-4 row g-5">
    <div class="col-md-8">
      <h3 class="pb-4 mb-4 border-bottom">基本情報</h3>

  <!-- 所属情報 -->  
      <article class="blog-post py-4">
        <h5 class="blog-post-title mb-1">■私の所属先</h5>
        <p >My Contact Information</p>

        <div class="py-4">
        <h2><?= $occupation ?></h2>
        <h2><?= $affiliation ?></h2>
        <p class="lead fw-bold"><?= $division ?></p>
        <p class="mb-4"><?= $start ?></p>
        <p class="mb-0"><?= $postal ?></p>
        <p class="mb-0"><?= $address01 ?> <?= $address02 ?></p>
        <p class="mb-0"><?= $phone ?></p>
        <p class="mb-0"><?= $fax ?></p>
        <p class="mb-3"><?= $url ?></p>
        <p class="mb-0"><?= $email ?></p>
        <p class="mb-0"><?= $mobile ?></p>
        </div>
    </article>

  <!-- 学歴情報 -->  
      <article class="blog-post py-4">
      <h5 class="blog-post-title mb-1">■私の出身校</h5>
       <p >My Educational Background</p>
        <table class="table my-4">
          <thead>
            <tr>
              <th>名称</th>
              <th>所属</th>
              <th>期間</th>
              <th>詳細</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?= $univ ?></td>
              <td><?= $univ_major ?></td>
              <td><?= $univ_period ?></td>
              <td><?= $univ_detail ?></td>
            </tr>
            <tr>
              <td><?= $hs ?></td>
              <td><?= $hs_major ?></td>
              <td><?= $hs_period ?></td>
              <td><?= $hs_detail ?></td>
              <td></td>
            </tr>
            <tr>
            <td><?= $grad ?></td>
              <td><?= $grad_major ?></td>
              <td><?= $grad_period ?></td>
              <td><?= $grad_detail ?></td>
            </tr>
          </tbody>
          <tfoot>
          </tfoot>
        </table>
      </article>


  <!-- 経歴情報 -->  
    <article class="blog-post py-4">
      <h5 class="blog-post-title mb-1">■私の経歴</h5>
       <p>My Business Experience</p>
        <table class="table my-4">
          <thead>
            <tr>
              <th>名称</th>
              <th>所属</th>
              <th>期間</th>
              <th>詳細</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?= $career01 ?></td>
              <td><?= $division01 ?></td>
              <td><?= $career01_period ?></td>
              <td><?= $career01_detail ?></td>
            </tr>
            <tr>
              <td><?= $career02 ?></td>
              <td><?= $division02 ?></td>
              <td><?= $career02_period ?></td>
              <td><?= $career02_detail ?></td>
            </tr>
            <tr>
              <td><?= $career03 ?></td>
              <td><?= $division03 ?></td>
              <td><?= $career03_period ?></td>
              <td><?= $career03_detail ?></td>
            </tr>
            </tr>
          </tbody>
          <tfoot>
          </tfoot>
        </table>
      </article>

      
    </div>


    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">

    <!-- 私のエピソード -->
        <div class="px-4 py-4 bg-light rounded">
          <h5 class="fw-bold mb-4">My Eisode / 私のエピソード</h5>
          <p class="fw-bold mb-4"><?= $episode ?></p>
          <p class="mb-0"><?= $episode_detail ?></p>
        </div>
    <!-- 私のモチベ -->
        <div class="px-4 py-5">
          <h5 class="fw-bold mb-4">My Motivation / 私のモチベ</h5>
          <p class="mb-0"><?= $motiv01 ?></p>
          <p class="mb-0"><?= $motiv02 ?></p>
          <p class="mb-0"><?= $motiv03 ?></p>
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
          <strong class="d-inline-block mb-2 text-primary">My OFF</strong>
          <h3 class="mb-1">オフの私</h3>
          <div class="mb-1 text-muted"><?= $date03 ?></div>
          <!-- <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p> -->
          <a href="profile_detail03.php?id=<?= $id ?>" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-flex align-items-center p-3">
        <?= $photo_off ?>
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
          <a href="profile_detail05.php?id=<?= $id ?>" class="stretched-link">Continue reading</a>
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