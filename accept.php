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
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


//３．データ表示
$id = '' or 
$photo = '' or 

$photo_on = '' or 
$catch_phrase_on = '' or
$name_j = '' or 
$name_e = '' or
$object = '' or

$episode = '' or 
$episode_detail = '';


if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {  
        //GETデータ送信リンク作成
        
        $id .= $result['id'];        
        $photo .= $result['photo_on'];

        $photo_on .= '<img src="./img/' . $result['photo_on'] . '" class="rounded img-fluid" width="200">';
        $catch_phrase_on .= $result['catch_phrase_on'];
        $name_j .= $result['name01j'] . '  ' . $result['name02j'];
        $name_e .= $result['name01e'] . '  ' . $result['name02e'];
        $object .= $result['lid'];        

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

	<meta property="og:locale" content="ja_JP" />
	<meta property="og:type" content="profile" />
	<meta property="og:title" content="<?= $name_j ?>：<?= $catch_phrase_on ?>" />
	<meta property="og:description" content="<?= $episode ?><?= $episode_detail ?>" />
	<meta property="og:url" content="http://www.selfy.co.jp/accept.php?id=<?= $id ?>" />
	<meta property="og:site_name" content="<?= $catch_phrase_on ?>" />
	<meta property="og:image" content="http://selfy.co.jp/img/<?= $photo ?>" />
	<meta property="og:image:type" content="image/jpeg" />


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">

    <title>受信する / Accept</title>

</head>

<body>

<div class="container-fluid">

<form method="POST" action="record_exchange01.php?id=<?= $id ?>" id="record01" name="record01">

        <!-- <h2>プロフィールの受信</h2>

        <fieldset>
            <ul>
                <h3>受信したプロフィール</h3>
                <div><?= $photo_on ?></div>
                <div><h3><?= $catch_phrase_on ?></h3></div>
                <div><?= $name_j ?></div>
                <div><?= $name_e ?></div>

                <div><p>さんのプロフィールを見ますか？</p></div>

                <input type="hidden" name="object" value="<?= $object ?>">
                <a id="submit"  class="btn btn-secondary">見てみる</a>
            
            </ul>
        </fieldset> -->

        <main class="container">
            <header class="pb-3 mb-4 border-bottom">
                <span class="fs-4">Accept / 受信する</span>
            </header>

            <div class="bg-light p-5 rounded">
                <h1>プロフィールの受信</h1>
                <br>
                <br>
                <div><?= $photo_on ?></div>
                <br>
                <div><h5><?= $catch_phrase_on ?></h5></div>
                <br>
                <div><h3><?= $name_j ?></h3></div>
                <div><h5><?= $name_e ?></h5 ></div>   
                <br>
                <p class="lead">さんのプロフィールを見ますか？</p>
                <input type="hidden" name="object" value="<?= $object ?>">

                <div class="pb-3">
                    <a id="submit" class="btn btn-primary col-md-4 px-4 me-md-2">View profile / 表示する</a>
                </div>
                <div class="pb-3">
                    <button type="button" class="btn btn-outline-secondary col-md-4 px-4" onclick="location.href='top.php'">TOP / トップへ &raquo;</button>
                </div>

            </div>
                <footer class="pt-3 mt-4 text-muted border-top"></footer>
        </main>


</form>

</div>


    
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<script>

// ボタンクリックでフォームを送信

$("#submit").click(function(){

$('#record01').submit();

});


</script>



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>