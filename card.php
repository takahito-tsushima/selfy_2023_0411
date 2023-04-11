<?php

// SESSION開始！！
session_start();
// 関数群の読み込み
require_once('funcs.php');
// ログインチェック処理！
// loginCheck();


$lid = $_SESSION['lid'];
$id = $_GET['id'];

// 関数ファイルでreturnで外に出した$pdoを使う
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM register01_on JOIN register00_photo USING(id) where id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();


//３．データ表示

$id = '' or 
$photo_card = '' or

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

        $id .= $result['id'];        
        $photo_card .= '<img class="rounded-circle rounded mx-auto d-block flex-shrink-0" src="./img/' . $result['photo_on'] . '" width="150" height="150">';

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
        $mobile .=  '携帯：' . '<a href="tel:' . $result['mobile'] . '">' . $result['mobile'] . '</a>';

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

    <title>Card / カード</title>

</head>

<body>


<div class="col-lg-5">

      <div class="row g-0 border rounded overflow-hidden flex-md-row bg-light shadow-sm h-md-250 position-relative">

        <div class="col-sm-4 d-flex align-items-center p-2">
          <?= $photo_card ?>
        </div>

        <div class="col-sm-8 p-2 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary"><?= $catch_phrase_on ?></strong>
          <h3 class="mb-1"><?= $name_j ?></h3>
          <lead class="mb-3 text-muted"><?= $name_e ?></lead>
          <h6 class="mb-1"><?= $episode ?></h6>
          <lead class="mb-3"><?= $episode_detail ?></lead>
          <!-- <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p> -->
          <div class="d-flex justify-content-left"><a href="" class="stretched-link">Click for the detail / 詳細はこちら</a></div>
        </div>


      </div>
 
      </div>



<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>