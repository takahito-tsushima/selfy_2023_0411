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
$stmt = $pdo->prepare('SELECT * FROM register05_history where lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();


//データ登録処理後  ※コピペ
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
// データが取得できた場合の処理  1件のみなのでwhile文は不要
$result = $stmt->fetch();

};


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

    <title>【 Selfy 】「私のヒストリー」の登録</title>

</head>

<body>

<div class="container">
  <main>
    <div class="py-5 text-center">
      <h1>登録画面</h1>
      <p class="lead">My History / 私のヒストリー</p>
    </div>

    <div class="offset-lg-2 col-md-7 col-lg-8 mb-5">
        <!-- <h4 class="mb-3">タイトル追加</h4> -->
        
        <form class="needs-validation" novalidate method="POST" action="update05_history.php" id="history" name="history">
          <div class="row g-3">
            <div class="col-12 mb-4">
              <h4 class="pb-2">幼少期の思い出</h4>
              <textarea rows="5" class="form-control"  maxlength=200 id="js_childhood" name="childhood" placeholder="200文字以内"><?= $result['childhood'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">学生時代の自分</h4>
              <textarea rows="5" class="form-control"  maxlength=200 id="js_teenage" name="teenage" placeholder="200文字以内"><?= $result['teenage'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">初めて社会に出たとき</h4>
              <textarea rows="5" class="form-control"  maxlength=200 id="js_new_grad" name="new_grad" placeholder="200文字以内"><?= $result['new_grad'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">転職の経験</h4>
              <textarea rows="5" class="form-control"  maxlength=200 id="js_job_change" name="job_change" placeholder="200文字以内"><?= $result['job_change'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">人生の転換点</h4>
              <textarea rows="5" class="form-control"  maxlength=200 id="js_crossroads" name="crossroads" placeholder="200文字以内"><?= $result['crossroads'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">将来の夢やビジョン</h4>
              <textarea rows="5" class="form-control"  maxlength=200 id="js_vision" name="vision" placeholder="200文字以内"><?= $result['vision'] ?></textarea>
            </div>
          </div>

          <hr class="my-4">

          <button type="submit" id="submit" class="w-100 btn btn-primary btn-lg mt-5">Submit / 登録する</button>
          <button type="button" class="w-100 btn btn-outline-secondary mt-4 mb-5" onclick="location.href='top.php'">Back to TOP / トップに戻る &raquo;</button>
        </form>
    
    </div>
  </main>

</div>



    
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<script>



// ボタンクリックでフォームを送信

$("#submit").click(function(){

$('#history').submit();

});



</script>



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>