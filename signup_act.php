<?php

// SESSION開始！！
session_start();
// 関数群の読み込み
require_once('funcs.php');
// // ログインチェック処理！
// loginCheck();


// ※ILTy動画より  ---- 入力チェック ---
// もしも、送られてこない or 空欄である 場合 ⇒ エラーを表示

if (!isset($_POST["lid"]) || $_POST["lid"]==""){
  exit("Parameter Error! lid!");
}

if (!isset($_POST["lpw"]) || $_POST["lpw"]==""){
  exit("Parameter Error! lpw!");
}


//1. POSTデータ取得
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

$photo_on = "placeholder.jpg";
$photo_off = "placeholder.jpg";
$photo_old = "placeholder.jpg";

  
  // ファイル名を決定。日付時間をファイル名に付与して、同じ名前をアップロードされても重複しないようにする。
  
  
  //1-2. FileUpload処理
  $upload = "./img/"; //画像アップロードフォルダへのパス
  //アップロードした画像を./img/へ移動させる記述↓
  
  if(move_uploaded_file($_FILES['photo_on']['tmp_name'], $upload.$photo_on)){
    //FileUpload:OK
  } else {
    //FileUpload:NG
    echo "Upload failed";
    echo $_FILES['photo_on']['error'];
  }
  
  if(move_uploaded_file($_FILES['photo_off']['tmp_name'], $upload.$photo_off)){
    //FileUpload:OK
  } else {
    //FileUpload:NG
    echo "Upload failed";
    echo $_FILES['photo_off']['error'];
  }
  
  if(move_uploaded_file($_FILES['photo_old']['tmp_name'], $upload.$photo_old)){
    //FileUpload:OK
  } else {
    //FileUpload:NG
    echo "Upload failed";
    echo $_FILES['photo_old']['error'];
  }
  
  


//2. DB接続します   try=内容を実行  catch=エラーがあれば処理を止めて以下を実行
$pdo = db_conn();


//３．データ登録SQL作成

// ※※※ register00_photoへの書き込み ※※※
// 1. SQL文を用意    【 処理の内容 を記述 】
$stmt = $pdo->prepare("INSERT INTO register00_photo(
  id,
  lid,
  lpw,
  photo_on,
  photo_off,
  photo_old,
  date)

VALUES(NULL,
  :lid,
  :lpw,
  :photo_on,
  :photo_off,
  :photo_old,
  sysdate() )" 
);

//  2. バインド変数を用意    【 SQL injection 攻撃の回避 】
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':photo_on', $photo_on, PDO::PARAM_STR);
$stmt->bindValue(':photo_off', $photo_off, PDO::PARAM_STR);
$stmt->bindValue(':photo_old', $photo_old, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();


// ※※※ register01_onへの書き込み ※※※
// 1. SQL文を用意    【 処理の内容 を記述 】
$stmt = $pdo->prepare("INSERT INTO register01_on(
  id,
  lid,
  date)

VALUES(NULL,
  :lid,
  sysdate() )" 
);

//  2. バインド変数を用意    【 SQL injection 攻撃の回避 】
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();


// ※※※ register02_torisetsuへの書き込み ※※※
// 1. SQL文を用意    【 処理の内容 を記述 】
$stmt = $pdo->prepare("INSERT INTO register02_torisetsu(
  id,
  lid,
  date)

VALUES(NULL,
  :lid,
  sysdate() )" 
);

//  2. バインド変数を用意    【 SQL injection 攻撃の回避 】
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();


// ※※※ register03_offへの書き込み ※※※
// 1. SQL文を用意    【 処理の内容 を記述 】
$stmt = $pdo->prepare("INSERT INTO register03_off(
  id,
  lid,
  date)

VALUES(NULL,
  :lid,
  sysdate() )" 
);

//  2. バインド変数を用意    【 SQL injection 攻撃の回避 】
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();


// ※※※ register04_truthへの書き込み ※※※
// 1. SQL文を用意    【 処理の内容 を記述 】
$stmt = $pdo->prepare("INSERT INTO register04_truth(
  id,
  lid,
  date)

VALUES(NULL,
  :lid,
  sysdate() )" 
);

//  2. バインド変数を用意    【 SQL injection 攻撃の回避 】
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();


// ※※※ register05_historyへの書き込み ※※※
// 1. SQL文を用意    【 処理の内容 を記述 】
$stmt = $pdo->prepare("INSERT INTO register05_history(
  id,
  lid,
  date)

VALUES(NULL,
  :lid,
  sysdate() )" 
);

//  2. バインド変数を用意    【 SQL injection 攻撃の回避 】
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();





//４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{



  //５．リダイレクト
header('Location: login.php');
}


?>
