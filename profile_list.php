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
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {      
        //GETデータ送信リンク作成
    
        $view .= '<div class="col-lg-4  p-4">';
        $view .= '<p class="text-center">'. $result['ex_date'] . '</p>';
        $view .= '<img class="rounded-circle rounded mx-auto d-block" src="./img/' . $result['photo_on'] . '" width="200" height="200">';
        $view .= '<p class="lead text-center pt-3">' . $result['catch_phrase_on'] . '</p>';
        $view .= '<h3 class="fw-bold text-center">' . $result['name01j'] . '  ' . $result['name02j'] . '</h3>';
        $view .= '<p class="fw-normal text-center">' . $result['name01e'] . '  ' . $result['name02e'] . '</p>';
        $view .= '<p><a class="btn btn-sm btn-secondary rounded mx-auto d-block" href="profile_detail01.php?id=' . $result['id'] . '">View details &raquo;</a></p>';
        

        $r = $result['object'];
        $stmt2 = $pdo->prepare("SELECT * FROM record_exchange where record_exchange.object = :lid and record_exchange.lid ='". $r ."'");
        $stmt2->bindValue(':lid', $lid, PDO::PARAM_STR);
        $status = $stmt2->execute();

        $check= $stmt2->rowCount();
        if ($check == 0){
            // $view .= '<div class="text-center"><a href="exchange.php?id=' . $result['id'] . '">交換する</a></div>';
            $view .= '<div class="text-center"><p class="bg-danger text-light">Exchange? / 交換できます！</p></div>';

        }else{
            $view .= '';
        }        

        $view .= '</div><!-- /.col-lg-4 -->';   

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

    <title>Profile List / プロフィール一覧</title>

</head>

<body>

<div class="container-fluid">

    <div class="my-5">
        <div><h1 class="fw-bold text-center">Profile List</h1></div>
        <div><h2 class="lead fw-bold text-center">プロフィール一覧</h2></div>

        <div class="pt-3"><?= $count ?></div>  

        <div class="container">
        <main class="container">

            <div class="row">
                <?= $view ?>
            </div><!-- /.row -->

        </main>
        </div>

        <div class="text-center py-5">
          <a class="btn btn-outline-secondary rounded mx-auto" href="top.php">TOP / トップへ戻る &raquo;</a>
        </div>

    </div>



</div>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>