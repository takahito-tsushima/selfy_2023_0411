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
$stmt = $pdo->prepare('SELECT * FROM register00_photo where lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();


//３．データ表示

$photo_on = '' or 
$photo_off = '' or 
$photo_old = '' ; 


if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {  
        //GETデータ送信リンク作成

        $photo_on .= '<img src="./img/' . $result['photo_on'] . '" width="200">';
        $photo_off .= '<img src="./img/' . $result['photo_off'] . '" width="200">';
        $photo_old .= '<img src="./img/' . $result['photo_old'] . '" width="200">';

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

    <title>私の写真</title>

</head>

<body>
    <div><h3>■オン / ON の写真</h3></div>
    <div><?= $photo_on ?></div>
    <div><h3>■オフ / OFF の写真</h3></div>
    <div><?= $photo_off ?></div>
    <div><h3>■昔の写真</h3></div>
    <div><?= $photo_old ?></div>



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>