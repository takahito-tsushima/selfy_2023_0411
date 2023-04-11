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
$stmt = $pdo->prepare('SELECT * FROM register03_off where lid = :lid');
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

    <title>【 Selfy 】「私のプロフ」の登録 - オフの私 / OFF</title>

</head>

<body>


<div class="container">
  <main>
    <div class="pt-5 pb-2 text-center">
      <h1>登録画面</h1>
      <p class="lead">My OFF / オフの私</p>
    </div>

    <div class="offset-lg-2 col-md-7 col-lg-8 mb-5">
        <!-- <h4 class="mb-3">タイトル追加</h4> -->    
      <form class="needs-validation" novalidate method="POST" action="update03_off.php" id="profileOFF" name="profileOFF">

        <section id="profileOff_01">
            <div class="pb-3 text-center">
            <p class="lead">1 / 2</p>
            </div>

            <p class="lead py-3">■基本情報</p>
          
          <div class="row g-3">      

            <div class="col-lg-6 mb-4">
              <label for="residence" class="form-label">居住エリア</label>
              <!-- <h4 class="pb-2">居住エリア</h4> -->
              <input type="text" class="form-control" maxlength=20  name="residence" placeholder="東京都 新宿区 など" value="<?= $result['residence'] ?>">
            </div>
            <div class="col-lg-6 mb-4">
              <label for="family" class="form-label">家族構成</label>
              <!-- <h4 class="pb-2">家族構成</h4> -->
              <input type="text" class="form-control" maxlength=30  name="family" placeholder="妻と子供２人 愛犬（ミニチュアシュナウザー）など" value="<?= $result['family'] ?>">
            </div>
            <div class="col-12 mb-4">
              <label for="hobby" class="form-label">趣味</label>
              <!-- <h4 class="pb-2">趣味</h4> -->
              <textarea rows="2" class="form-control"  maxlength=30 name="hobby"><?= $result['hobby'] ?></textarea>
            </div>

            <div class="col-md-3 mb-4">
              <label for="time_weekday" class="form-label">睡眠時間（平日）</label>
              <select class="form-select" name="time_weekday">
                <option value="" <?php if ($result['time_weekday'] == "") echo 'selected'; ?>>時間を選択</option>
                <option value="0 時間" <?php if ($result['time_weekday'] == "0 時間") echo 'selected'; ?>>0 時間</option>    
                <option value="1 時間" <?php if ($result['time_weekday'] == "1 時間") echo 'selected'; ?>>1 時間</option>    
                <option value="2 時間" <?php if ($result['time_weekday'] == "2 時間") echo 'selected'; ?>>2 時間</option>    
                <option value="3 時間" <?php if ($result['time_weekday'] == "3 時間") echo 'selected'; ?>>3 時間</option>    
                <option value="4 時間" <?php if ($result['time_weekday'] == "4 時間") echo 'selected'; ?>>4 時間</option>    
                <option value="5 時間" <?php if ($result['time_weekday'] == "5 時間") echo 'selected'; ?>>5 時間</option>    
                <option value="6 時間" <?php if ($result['time_weekday'] == "6 時間") echo 'selected'; ?>>6 時間</option>    
                <option value="7 時間" <?php if ($result['time_weekday'] == "7 時間") echo 'selected'; ?>>7 時間</option>    
                <option value="8 時間" <?php if ($result['time_weekday'] == "8 時間") echo 'selected'; ?>>8 時間</option>    
                <option value="9 時間" <?php if ($result['time_weekday'] == "9 時間") echo 'selected'; ?>>9 時間</option>    
                <option value="10 時間" <?php if ($result['time_weekday'] == "10 時間") echo 'selected'; ?>>10 時間</option>    
                <option value="11 時間" <?php if ($result['time_weekday'] == "11 時間") echo 'selected'; ?>>11 時間</option>    
                <option value="12 時間" <?php if ($result['time_weekday'] == "12 時間") echo 'selected'; ?>>12 時間</option>    
                <option value="13 時間" <?php if ($result['time_weekday'] == "13 時間") echo 'selected'; ?>>13 時間</option>    
                <option value="14 時間" <?php if ($result['time_weekday'] == "14 時間") echo 'selected'; ?>>14 時間</option>    
                <option value="15 時間" <?php if ($result['time_weekday'] == "15 時間") echo 'selected'; ?>>15 時間</option>    
                <option value="16 時間" <?php if ($result['time_weekday'] == "16 時間") echo 'selected'; ?>>16 時間</option>    
                <option value="17 時間" <?php if ($result['time_weekday'] == "17 時間") echo 'selected'; ?>>17 時間</option>    
                <option value="18 時間" <?php if ($result['time_weekday'] == "18 時間") echo 'selected'; ?>>18 時間</option>    
                <option value="19 時間" <?php if ($result['time_weekday'] == "19 時間") echo 'selected'; ?>>19 時間</option>    
                <option value="20 時間" <?php if ($result['time_weekday'] == "20 時間") echo 'selected'; ?>>20 時間</option>    
                <option value="21 時間" <?php if ($result['time_weekday'] == "21 時間") echo 'selected'; ?>>21 時間</option>    
                <option value="22 時間" <?php if ($result['time_weekday'] == "22 時間") echo 'selected'; ?>>22 時間</option>    
                <option value="23 時間" <?php if ($result['time_weekday'] == "23 時間") echo 'selected'; ?>>23 時間</option>    
                <option value="24 時間" <?php if ($result['time_weekday'] == "24 時間") echo 'selected'; ?>>24 時間</option>    
              </select>
            </div>

            <div class="col-md-3 mb-4">
              <label for="time_weekend" class="form-label">睡眠時間（休日）</label>
              <select class="form-select" name="time_weekend">
                <option value="" <?php if ($result['time_weekend'] == "") echo 'selected'; ?>>時間を選択</option>
                <option value="0 時間" <?php if ($result['time_weekend'] == "0 時間") echo 'selected'; ?>>0 時間</option>    
                <option value="1 時間" <?php if ($result['time_weekend'] == "1 時間") echo 'selected'; ?>>1 時間</option>    
                <option value="2 時間" <?php if ($result['time_weekend'] == "2 時間") echo 'selected'; ?>>2 時間</option>    
                <option value="3 時間" <?php if ($result['time_weekend'] == "3 時間") echo 'selected'; ?>>3 時間</option>    
                <option value="4 時間" <?php if ($result['time_weekend'] == "4 時間") echo 'selected'; ?>>4 時間</option>    
                <option value="5 時間" <?php if ($result['time_weekend'] == "5 時間") echo 'selected'; ?>>5 時間</option>    
                <option value="6 時間" <?php if ($result['time_weekend'] == "6 時間") echo 'selected'; ?>>6 時間</option>    
                <option value="7 時間" <?php if ($result['time_weekend'] == "7 時間") echo 'selected'; ?>>7 時間</option>    
                <option value="8 時間" <?php if ($result['time_weekend'] == "8 時間") echo 'selected'; ?>>8 時間</option>    
                <option value="9 時間" <?php if ($result['time_weekend'] == "9 時間") echo 'selected'; ?>>9 時間</option>    
                <option value="10 時間" <?php if ($result['time_weekend'] == "10 時間") echo 'selected'; ?>>10 時間</option>    
                <option value="11 時間" <?php if ($result['time_weekend'] == "11 時間") echo 'selected'; ?>>11 時間</option>    
                <option value="12 時間" <?php if ($result['time_weekend'] == "12 時間") echo 'selected'; ?>>12 時間</option>    
                <option value="13 時間" <?php if ($result['time_weekend'] == "13 時間") echo 'selected'; ?>>13 時間</option>    
                <option value="14 時間" <?php if ($result['time_weekend'] == "14 時間") echo 'selected'; ?>>14 時間</option>    
                <option value="15 時間" <?php if ($result['time_weekend'] == "15 時間") echo 'selected'; ?>>15 時間</option>    
                <option value="16 時間" <?php if ($result['time_weekend'] == "16 時間") echo 'selected'; ?>>16 時間</option>    
                <option value="17 時間" <?php if ($result['time_weekend'] == "17 時間") echo 'selected'; ?>>17 時間</option>    
                <option value="18 時間" <?php if ($result['time_weekend'] == "18 時間") echo 'selected'; ?>>18 時間</option>    
                <option value="19 時間" <?php if ($result['time_weekend'] == "19 時間") echo 'selected'; ?>>19 時間</option>    
                <option value="20 時間" <?php if ($result['time_weekend'] == "20 時間") echo 'selected'; ?>>20 時間</option>    
                <option value="21 時間" <?php if ($result['time_weekend'] == "21 時間") echo 'selected'; ?>>21 時間</option>    
                <option value="22 時間" <?php if ($result['time_weekend'] == "22 時間") echo 'selected'; ?>>22 時間</option>    
                <option value="23 時間" <?php if ($result['time_weekend'] == "23 時間") echo 'selected'; ?>>23 時間</option>    
                <option value="24 時間" <?php if ($result['time_weekend'] == "24 時間") echo 'selected'; ?>>24 時間</option>    
              </select>
            </div>

            <div class="col-12 pb-4">
              <label for="catch_phrase_off" class="form-label">Facebook</label>
              <!-- <h4 class="pb-2">Facebook</h4> -->
              <input type="url" class="form-control" name="facebook" placeholder="" value="<?= $result['facebook'] ?>">
            </div>
            <div class="col-12 pb-4">
              <label for="catch_phrase_off" class="form-label">Instagram</label>
              <!-- <h4 class="pb-2">Instagram</h4> -->
              <input type="url" class="form-control" name="instagram" placeholder="" value="<?= $result['instagram'] ?>">
            </div>
            <div class="col-12 pb-4">
              <label for="catch_phrase_off" class="form-label">Twitter</label>
              <!-- <h4 class="pb-2">Twitter</h4> -->
              <input type="url" class="form-control" name="twitter" placeholder="" value="<?= $result['twitter'] ?>">
            </div>
        
            <div class="col-12 pb-4">
              <!-- <label for="catch_phrase_off" class="form-label">休日の私をひとことで！</label> -->
              <h4 class="pb-2">休日の私をひとことで！</h4>
              <input type="text" class="form-control" maxlength=20  name="catch_phrase_off" placeholder="" value="<?= $result['catch_phrase_off'] ?>">
            </div>

            <a type="button" id="go_to_profileOff_02" class="w-100 btn btn-primary mt-4 mb-5">次へ</a>

        </div>
        </section>


        <section id="profileOff_02">
            <div class="pb-3 text-center">
            <p class="lead">2 / 2</p>
            </div>

            <p class="lead py-3">■私のお気に入り</p>

          <div class="row g-3">
            <div class="col-12 mb-4">
              <h4 class="pb-2">休日の過ごし方</h4>
              <textarea rows="2" class="form-control"  maxlength=200 id="js_holiday" name="holiday" placeholder="200文字以内"><?= $result['holiday'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">興味関心のあること</h4>
              <textarea rows="2" class="form-control"  maxlength=200 id="js_interest" name="interest" placeholder="200文字以内"><?= $result['interest'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">ハマっているもの</h4>
              <textarea rows="2" class="form-control"  maxlength=200 id="js_crazy" name="crazy" placeholder="200文字以内"><?= $result['crazy'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">最近好きになったもの</h4>
              <textarea rows="2" class="form-control"  maxlength=200 id="js_love" name="love" placeholder="200文字以内"><?= $result['love'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">大切にしているもの</h4>
              <textarea rows="2" class="form-control"  maxlength=200 id="js_important" name="important" placeholder="200文字以内"><?= $result['important'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">自慢のコレクション</h4>
              <textarea rows="2" class="form-control"  maxlength=200 id="js_collection" name="collection" placeholder="200文字以内"><?= $result['collection'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">一番高価な買い物</h4>
              <textarea rows="2" class="form-control"  maxlength=200 id="js_expensive" name="expensive" placeholder="200文字以内"><?= $result['expensive'] ?></textarea>
            </div>
            <div class="col-12 mb-4">
              <h4 class="pb-2">尊敬する人や憧れの人</h4>
              <textarea rows="2" class="form-control"  maxlength=200 id="js_respect" name="respect" placeholder="200文字以内"><?= $result['respect'] ?></textarea>
            </div>

            <a type="button" id="back_to_profileOff_01" class="w-100 btn btn-secondary mt-4 mb-5">戻る</a>

            <hr class="my-4">

            <button type="submit" id="submit" class="w-100 btn btn-primary btn-lg mt-5">Submit / 登録する</button>

          </div>
        </section>


          <a type="button" class="w-100 btn btn-outline-secondary mt-4 mb-5" onclick="location.href='top.php'">Back to TOP / トップに戻る &raquo;</a>

        </form>
    
    </div>
  </main>

</div>
            
    


    
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<script>

// 画面遷移
$('#profileOff_01').show();
$('#profileOff_02').hide();

$("#go_to_profileOff_02").on('click',function(){
    $('#profileOff_01').toggle();  //hide
    $('#profileOff_02').toggle();  //show
    $("html,body").scrollTop(0); // 画面の一番上にスクロール
});

$("#back_to_profileOff_01").on('click',function() {
    $('#profileOff_01').toggle();  //show
    $('#profileOff_02').toggle();  // hide
    $("html,body").scrollTop(0); // 画面の一番上にスクロール
});


// 睡眠時間のプルダウン作成
function SelectBoxCreate(start, end){
    let str = "";
    for(let i=start; i<end; i++){
        str += `<option>${i}</option>`;
    }
    return str;
}

const hour = SelectBoxCreate(0,25);

$("#js_time_weekday").html(hour);    
$("#js_time_weekend").html(hour);    



// ボタンクリックでフォームを送信

$("#submit").click(function(){

$('#profileOFF').submit();

});



</script>



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>