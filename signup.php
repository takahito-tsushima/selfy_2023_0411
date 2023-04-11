<?php

// SESSION開始！！
session_start();
// 関数群の読み込み
require_once('funcs.php');
// // ログインチェック処理！
// loginCheck();

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

    <title>【 Selfy 】アカウント作成</title>

</head>

<body>

<div class="container-fluid">

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-1 fw-bold lh-1 mb-4">Selfy</h1>
        <h1 class="display-6 fw-bold lh-1 mb-5">Sign up / アカウントの作成</h1>
        <p class="col-lg-10 fs-4 mb-5">新しい世界へようこそ。さあ始めましょう！</p>
      </div>
    <div class="col-md-10 mx-auto col-lg-5">

      <form method="POST" action="signup_act.php" name="sign_up" class="p-4 p-md-5 border rounded-3 bg-light">
          <div class="form-floating mb-3">
            <input type="text" name="lid" class="form-control" id="floatingInput" placeholder="Phone Number">
            <label for="floatingInput">Phone number</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="lpw" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
          <hr class="my-4">
          <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
          <div>
                <br><p>ログインは<a href="login.php">こちら</a></p>
          </div>
      </form>

    </div>
    </div>
  </div>
</div>
    


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>