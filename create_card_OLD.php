<?php

// SESSION開始！！
session_start();
// 関数群の読み込み
require_once('funcs.php');
// ログインチェック処理！
// loginCheck();


$lid = $_SESSION['lid'];

// 関数ファイルでreturnで外に出した$pdoを使う
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM register01_on JOIN register00_photo USING(lid) where lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();


//３．データ表示

$id = '' or 
$photo = '' or 

$photo_on = '' or 
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
$univ_period = '' or 

$hs = '' or 
$hs_period = '' or 

$grad = '' or 
$grad_period = '' or 

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
        $photo .= $result['photo_on'];
        
        $photo_on .= '<img src="./img/' . $result['photo_on'] . '" width="200">';
        $catch_phrase_on .= $result['catch_phrase_on'];
        $name_j .= $result['name01j'] . '  ' . $result['name02j'];
        $name_e .= $result['name01e'] . '  ' . $result['name02e'];
        $birth .= '生年月： ' . $result['birth_year']. '年 ' . $result['birth_month']. '月';
        $born .= '出身： ' . $result['born_place']. ' / ' . $result['prefecture'] . $result['country'];

        $affiliation .= $result['affiliation'];
        $division .= $result['division'];
        $start .= '入社： ' . $result['start_year']. '年 ' . $result['start_month']. '月';

        $postal .= '住所： 〒' . $result['postal'];
        $address01 .= '　　　 ' . $result['address01'];
        $address02 .= '　　　 ' .  $result['address02'];
        $phone .=  '電話： ' . $result['phone'];
        $fax .=  'FAX： ' . $result['fax'];
        $url .=  'HP： ' . $result['url'];
        $email .=  'Email： ' . $result['email'];
        $mobile .=  '携帯： ' . $result['mobile'];

        $univ .= $result['univ']. ' / ' . $result['univ_major'];
        $univ_period .= '（' . $result['univ_start_year']. '年' . $result['univ_start_month']. '月～' . $result['univ_end_year']. '年' . $result['univ_end_month']. '月）';

        $hs .= $result['hs']. ' / ' . $result['hs_major'];
        $hs_period .= '（' . $result['hs_start_year']. '年' . $result['hs_start_month']. '月～' . $result['hs_end_year']. '年' . $result['hs_end_month']. '月）';

        $grad .= $result['grad']. ' / ' . $result['grad_major'];
        $grad_period .= '（' . $result['grad_start_year']. '年' . $result['grad_start_month']. '月～' . $result['grad_end_year']. '年' . $result['grad_end_month']. '月）';

        $career01 .= $result['career01'];
        $division01 .= $result['division01'];
        $career01_period .= '（' . $result['career01_start_year']. '年' . $result['career01_start_month']. '月～' . $result['career01_end_year']. '年' . $result['career01_end_month']. '月）';
        $career01_detail .= $result['career01_detail'];

        $career02 .= $result['career02'];
        $division02 .= $result['division02'];
        $career02_period .= '（' . $result['career02_start_year']. '年' . $result['career02_start_month']. '月～' . $result['career02_end_year']. '年' . $result['career02_end_month']. '月）';
        $career02_detail .= $result['career02_detail'];

        $career03 .= $result['career03'];
        $division03 .= $result['division03'];
        $career03_period .= '（' . $result['career03_start_year']. '年' . $result['career03_start_month']. '月～' . $result['career03_end_year']. '年' . $result['career03_end_month']. '月）';
        $career03_detail .= $result['career03_detail'];

        $motiv01 .= $result['motiv01'];
        $motiv02 .= $result['motiv02'];
        $motiv03 .= $result['motiv03'];

        $episode .= $result['episode'];
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

	<meta property="og:title" content="<?= $catch_phrase_on ?>" />
	<meta property="og:description" content="ディスクリプションを記入する" />
	<meta property="og:url" content="www.selfy.co.jp/accept.php?id=<?= $id ?>" />
	<meta property="og:site_name" content="Selfy - プロフィールアプリ" />
	<meta property="og:image" content="http://selfy.co.jp/img/<?= $photo ?>" />


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">

    <title>オンの私 / ON</title>

</head>

<body>

    <section id="card">
    <div><?= $photo_on ?></div>
    <div><h3><?= $catch_phrase_on ?></h3></div>
    <div><?= $name_j ?></div>
    <div><?= $name_e ?></div>
    <div><?= $birth ?></div>
    <div><?= $born ?></div>

    <div><?= $occupation ?></div>
    <div><?= $affiliation ?></div>
    <div><?= $division ?></div>
    <div><?= $start ?></div>

    <div><?= $postal ?></div>
    <div><?= $address01 ?></div>
    <div><?= $address02 ?></div>
    <div><?= $phone ?></div>
    <div><?= $fax ?></div>
    <div><?= $url ?></div>
    <div><?= $email ?></div>
    <div><?= $mobile ?></div>
    </section>


    <input id="preview" type="button" value="プレビュー"/>
    <a id="download" href="#">ダウンロード</a>
    <br/>
    <h3>プレビュー :</h3>
    <div id="previewImage">
    </div>

 

    <!-- <div><h3>■私の経歴 / My Career</h3></div>
    <div><?= $univ ?></div>
    <div><?= $univ_period ?></div>

    <div><?= $hs ?></div>
    <div><?= $hs_period ?></div>

    <div><?= $grad ?></div>
    <div><?= $grad_period ?></div>

    <div><?= $career01 ?></div>
    <div><?= $division01 ?></div>
    <div><?= $career01_period ?></div>
    <div><?= $career01_detail ?></div>

    <div><?= $career02 ?></div>
    <div><?= $division02 ?></div>
    <div><?= $career02_period ?></div>
    <div><?= $career02_detail ?></div>

    <div><?= $career03 ?></div>
    <div><?= $division03 ?></div>
    <div><?= $career03_period ?></div>
    <div><?= $career03_detail ?></div>

    <div><h3>■私のモチベ / My Motivation</h3></div>
    <div><?= $motiv01 ?></div>       
    <div><?= $motiv02 ?></div>       
    <div><?= $motiv03 ?></div>       
    

    <div><h3>■私のエピソード / My Eisode</h3></div>
    <div><?= $episode ?></div>
    <div><?= $episode_detail ?></div> -->



<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>



<script>

var element = $("#card"); // 画像化したい要素をセレクタに指定
var getCanvas; 
  
    //プレビュー
    $("#preview").on('click', function () {
         html2canvas(element, {
         onrendered: function (canvas) {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
             }
         });
    });
 
    // コンバートしてダウンロード
  $("#download").on('click', function () {
    var imgageData = getCanvas.toDataURL("image/png");
    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    //ファイル名を設定
    $("#download").attr("download", "hogehoge.png").attr("href", newData);
  });

</script>



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>


</html>