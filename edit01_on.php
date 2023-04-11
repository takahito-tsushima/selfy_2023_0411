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
$stmt = $pdo->prepare('SELECT * FROM register01_on where lid = :lid');
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

    <title>【 Selfy 】「私のプロフ」の登録 - オンの私 / ON</title>

</head>

<body>


<div class="container">
  <main>
    <div class="pt-5 pb-2 text-center">
      <h1>登録画面</h1>
      <p class="lead">My ON / オンの私</p>
    </div>

    <div class="offset-lg-2 col-md-7 col-lg-8 mb-5">
        <!-- <h4 class="mb-3">タイトル追加</h4> -->    
      <form class="needs-validation" novalidate method="POST" action="update01_on.php" id="profileON" name="profileON">

        <section id="profileOn_01">
            <div class="pb-3 text-center">
            <p class="lead">1 / 3</p>
            </div>

            <p class="lead py-3">■基本情報</p>

          <div class="row g-3">      
            <div class="col-lg-6 mb-4">
              <label for="residence" class="form-label">姓（漢字）</label>
              <!-- <h4 class="pb-2">姓（漢字）</h4> -->
              <input type="text" class="form-control" maxlength=20  name="name01j" placeholder="姓" value="<?= $result['name01j'] ?>">
            </div>
            <div class="col-lg-6 mb-4">
              <label for="residence" class="form-label">名（漢字）</label>
              <!-- <h4 class="pb-2">名（漢字）</h4> -->
              <input type="text" class="form-control" maxlength=20  name="name02j" placeholder="名" value="<?= $result['name02j'] ?>">
            </div>
            <div class="col-lg-6 mb-4">
              <label for="residence" class="form-label">姓（ローマ字）</label>
              <!-- <h4 class="pb-2">姓（ローマ字）</h4> -->
              <input type="text" class="form-control" maxlength=20  name="name01e" placeholder="Family Name" value="<?= $result['name01e'] ?>">
            </div>
            <div class="col-lg-6 mb-4">
              <label for="residence" class="form-label">名（ローマ字）</label>
              <!-- <h4 class="pb-2">名（ローマ字）</h4> -->
              <input type="text" class="form-control" maxlength=20  name="name02e" placeholder="First Name" value="<?= $result['name02e'] ?>">
            </div>
        
            <div class="form-group row mb-4">
              <label for="birth_year" class="form-label">生年月</label>
              <!-- <h4 class="pb-2">生年月</h4> -->
                <div class="col-lg-5"> 
                    <input type="text" class="form-control" maxlength=4  name="birth_year" placeholder="西暦" value="<?= $result['birth_year'] ?>">
                </div>
                <label for="birth_year" class="col-lg-1 col-form-label">年</label>
                  <!-- <label for="birth_year" class="form-label">生年月</label> -->
              <!-- <h4 class="pb-2">生年月</h4> -->
                <div class="col-lg-5"> 
                    <input type="text" class="form-control" maxlength=2  name="birth_month" placeholder="月" value="<?= $result['birth_month'] ?>">
                </div>
                <label for="birth_month" class="col-lg-1 col-form-label">月</label>
            </div>
                
            <div class="form-group row mb-4">
              <label for="born_place" class="form-label">出身地</label>
 
                <div class="col-md-2">
                    <input required type="radio" class="form-check-input" name="born_place" id="js_domestic" value="日本" <?php if ($result['born_place'] == "日本") echo 'checked'; ?>>
                    <label for="js_domestic" class="form-check-label">国内</label>
                </div>     

                <div class="col-md-4">
                    <select class="form-select" name="prefecture" id="js_born_domestic">
                        <option value="" <?php if ($result['prefecture'] == "") echo 'selected'; ?>>都道府県を選択</option>
                        <option value="北海道" <?php if ($result['prefecture'] == "北海道") echo 'selected'; ?>>北海道</option>
                        <option value="青森県" <?php if ($result['prefecture'] == "青森県") echo 'selected'; ?>>青森県</option>
                        <option value="岩手県" <?php if ($result['prefecture'] == "岩手県") echo 'selected'; ?>>岩手県</option>
                        <option value="宮城県" <?php if ($result['prefecture'] == "宮城県") echo 'selected'; ?>>宮城県</option>
                        <option value="秋田県" <?php if ($result['prefecture'] == "秋田県") echo 'selected'; ?>>秋田県</option>
                        <option value="山形県" <?php if ($result['prefecture'] == "山形県") echo 'selected'; ?>>山形県</option>
                        <option value="福島県" <?php if ($result['prefecture'] == "福島県") echo 'selected'; ?>>福島県</option>
                        <option value="茨城県" <?php if ($result['prefecture'] == "茨城県") echo 'selected'; ?>>茨城県</option>
                        <option value="栃木県" <?php if ($result['prefecture'] == "栃木県") echo 'selected'; ?>>栃木県</option>
                        <option value="群馬県" <?php if ($result['prefecture'] == "群馬県") echo 'selected'; ?>>群馬県</option>
                        <option value="埼玉県" <?php if ($result['prefecture'] == "埼玉県") echo 'selected'; ?>>埼玉県</option>
                        <option value="千葉県" <?php if ($result['prefecture'] == "千葉県") echo 'selected'; ?>>千葉県</option>
                        <option value="東京都" <?php if ($result['prefecture'] == "東京都") echo 'selected'; ?>>東京都</option>
                        <option value="神奈川県" <?php if ($result['prefecture'] == "神奈川県") echo 'selected'; ?>>神奈川県</option>
                        <option value="新潟県" <?php if ($result['prefecture'] == "新潟県") echo 'selected'; ?>>新潟県</option>
                        <option value="富山県" <?php if ($result['prefecture'] == "富山県") echo 'selected'; ?>>富山県</option>
                        <option value="石川県" <?php if ($result['prefecture'] == "石川県") echo 'selected'; ?>>石川県</option>
                        <option value="福井県" <?php if ($result['prefecture'] == "福井県") echo 'selected'; ?>>福井県</option>
                        <option value="山梨県" <?php if ($result['prefecture'] == "山梨県") echo 'selected'; ?>>山梨県</option>
                        <option value="長野県" <?php if ($result['prefecture'] == "長野県") echo 'selected'; ?>>長野県</option>
                        <option value="岐阜県" <?php if ($result['prefecture'] == "岐阜県") echo 'selected'; ?>>岐阜県</option>
                        <option value="静岡県" <?php if ($result['prefecture'] == "静岡県") echo 'selected'; ?>>静岡県</option>
                        <option value="愛知県" <?php if ($result['prefecture'] == "愛知県") echo 'selected'; ?>>愛知県</option>
                        <option value="三重県" <?php if ($result['prefecture'] == "三重県") echo 'selected'; ?>>三重県</option>
                        <option value="滋賀県" <?php if ($result['prefecture'] == "滋賀県") echo 'selected'; ?>>滋賀県</option>
                        <option value="京都府" <?php if ($result['prefecture'] == "京都府") echo 'selected'; ?>>京都府</option>
                        <option value="大阪府" <?php if ($result['prefecture'] == "大阪府") echo 'selected'; ?>>大阪府</option>
                        <option value="兵庫県" <?php if ($result['prefecture'] == "兵庫県") echo 'selected'; ?>>兵庫県</option>
                        <option value="奈良県" <?php if ($result['prefecture'] == "奈良県") echo 'selected'; ?>>奈良県</option>
                        <option value="和歌山県" <?php if ($result['prefecture'] == "和歌山県") echo 'selected'; ?>>和歌山県</option>
                        <option value="鳥取県" <?php if ($result['prefecture'] == "鳥取県") echo 'selected'; ?>>鳥取県</option>
                        <option value="島根県" <?php if ($result['prefecture'] == "島根県") echo 'selected'; ?>>島根県</option>
                        <option value="岡山県" <?php if ($result['prefecture'] == "岡山県") echo 'selected'; ?>>岡山県</option>
                        <option value="広島県" <?php if ($result['prefecture'] == "広島県") echo 'selected'; ?>>広島県</option>
                        <option value="山口県" <?php if ($result['prefecture'] == "山口県") echo 'selected'; ?>>山口県</option>
                        <option value="徳島県" <?php if ($result['prefecture'] == "徳島県") echo 'selected'; ?>>徳島県</option>
                        <option value="香川県" <?php if ($result['prefecture'] == "香川県") echo 'selected'; ?>>香川県</option>
                        <option value="愛媛県" <?php if ($result['prefecture'] == "愛媛県") echo 'selected'; ?>>愛媛県</option>
                        <option value="高知県" <?php if ($result['prefecture'] == "高知県") echo 'selected'; ?>>高知県</option>
                        <option value="福岡県" <?php if ($result['prefecture'] == "福岡県") echo 'selected'; ?>>福岡県</option>
                        <option value="佐賀県" <?php if ($result['prefecture'] == "佐賀県") echo 'selected'; ?>>佐賀県</option>
                        <option value="長崎県" <?php if ($result['prefecture'] == "長崎県") echo 'selected'; ?>>長崎県</option>
                        <option value="熊本県" <?php if ($result['prefecture'] == "熊本県") echo 'selected'; ?>>熊本県</option>
                        <option value="大分県" <?php if ($result['prefecture'] == "大分県") echo 'selected'; ?>>大分県</option>
                        <option value="宮崎県" <?php if ($result['prefecture'] == "宮崎県") echo 'selected'; ?>>宮崎県</option>
                        <option value="鹿児島県" <?php if ($result['prefecture'] == "鹿児島県") echo 'selected'; ?>>鹿児島県</option>
                        <option value="沖縄県" <?php if ($result['prefecture'] == "沖縄県") echo 'selected'; ?>>沖縄県</option>
                    </select>
                </div>     

                <div class="col-md-2">
                    <input required type="radio" class="form-check-input" name="born_place" id="js_overseas" value="海外" <?php if ($result['born_place'] == "海外") echo 'checked'; ?>>
                    <label for="js_overseas" class="form-check-label">海外</label>
                </div>     
                <div class="col-md-4">
                    <input type="text" class="form-control" maxlength=20  name="country" id="js_born_overseas" placeholder="国名" value="<?= $result['country'] ?>">
                </div>     
    
            </div>


            <hr class="my-5">

            <p class="lead py-3">■私の所属先</p>
      
                <div class="col-md-3" id="js-occupation_area">
                  <label for="occupation" class="form-label">職業</label>
                  <select class="form-select" name="occupation" id="js-occupation">
                    <option id="js_occupation_blanc" value="未選択" <?php if ($result['occupation'] == "未選択") echo 'selected'; ?>>未選択</option>    
                    <option id="js_business_person" value="会社員・公務員" <?php if ($result['occupation'] == "会社員・公務員") echo 'selected'; ?>>会社員・公務員</option>
                    <option id="js_part_timer" value="パート・アルバイト" <?php if ($result['occupation'] == "パート・アルバイト") echo 'selected'; ?>>パート・アルバイト</option>
                    <option id="js_company_executive" value="経営者・役員" <?php if ($result['occupation'] == "経営者・役員") echo 'selected'; ?>>経営者・役員</option>
                    <option id="js_freelance" value="フリーランス" <?php if ($result['occupation'] == "フリーランス") echo 'selected'; ?>>フリーランス</option>
                    <option id="js_professional" value="士業・専門職" <?php if ($result['occupation'] == "士業・専門職") echo 'selected'; ?>>士業・専門職</option>
                    <option id="js_student" value="学生" <?php if ($result['occupation'] == "学生") echo 'selected'; ?>>学生</option>
                    <option id="js_house_person" value="主婦・主夫" <?php if ($result['occupation'] == "主婦・主夫") echo 'selected'; ?>>主婦・主夫</option>
                    <option id="js_other_person" value="その他" <?php if ($result['occupation'] == "その他") echo 'selected'; ?>>その他</option>
                  </select>
                </div>


                    <!-- <div id="js_company_name" class="occupation-detail">
                        <li id="js_company_area"><P>勤務先</P></li>
                        <li><input id="js_company" class="" type="text" name="affiliation" value="<?= $result['affiliation'] ?>"></li>
                        <li id="js_division_area"><P>部署名・役職名</P></li>
                        <li><input id="js_division" class="" type="text" name="division" value="<?= $result['division'] ?>"></li>
                        <li><P>入社年月</P></li>
                    </div>
                    <div id="js_business_name" class="occupation-detail">
                        <li><P>職種名</P></li>
                        <li id="js_description_area"><input id="js_description" class="" type="text" name="description" value="<?= $result['description'] ?>"></li>
                        <li><P>開始年月</P></li>
                    </div>
                    <div id="js_school_name" class="occupation-detail">
                        <li><P>学校名</P></li>
                        <li id="js_school_area"><input id="js_school" class="" type="text" name="affiliation" value="<?= $result['affiliation'] ?>"></li>
                        <li><P>学部・学科・学年</P></li>
                        <li id="js_grade_area"><input id="js_grade" class="" type="text" name="division" value="<?= $result['division'] ?>"></li>
                        <li><P>入学年月</P></li>
                    </div>
                    <div id="js_others_name" class="occupation-detail">
                        <li><P>職種名</P></li>
                        <li id="js_description_area"><input id="js_description" class="" type="text" name="description" value="<?= $result['description'] ?>"></li>
                    </div> -->

                    <div id="js_company_name">
                        <label for="" class="form-label">勤務先</label>
                    </div>
                    <div id="js_business01_name">
                        <label for="" class="form-label">職種名①</label>
                    </div>
                    <div id="js_school_name">
                        <label for="" class="form-label">学校名</label>
                    </div>
                    <div class="col-lg-6 mb-4" id="js_affiliation">
                        <input type="text" class="form-control" maxlength=20  name="affiliation" placeholder="" value="<?= $result['affiliation'] ?>">
                    </div>

                    <div id="js_division_name">
                        <label for="" class="form-label">部署名・役職名</label>
                    </div>
                    <div id="js_business02_name">
                        <label for="" class="form-label">職種名②</label>
                    </div>
                    <div id="js_department_name">
                        <label for="" class="form-label">学部・学科・学年</label>
                    </div>
                    <div class="col-lg-6 mb-4" id="js_division">
                        <input type="text" class="form-control" maxlength=20  name="division" placeholder="" value="<?= $result['division'] ?>">
                    </div>
    
                    <div id="js_company_start">
                        <label for="" class="form-label">入社年月</label>
                    </div>
                    <div id="js_business_start">
                        <label for="" class="form-label">開始年月</label>
                    </div>
                    <div id="js_school_start">
                        <label for="" class="form-label">入学年月</label>
                    </div>
                    <div class="form-group row mb-4" id="js_start">
                        <div class="col-lg-5"> 
                            <input type="text" class="form-control" maxlength=4  name="start_year" placeholder="西暦" value="<?= $result['start_year'] ?>">
                        </div>
                        <label for="start_year" class="col-lg-1 col-form-label">年</label>
                        <div class="col-lg-5"> 
                            <input type="text" class="form-control" maxlength=20  name="start_month" placeholder="月" value="<?= $result['start_month'] ?>">
                        </div>
                        <label for="start_month" class="col-lg-1 col-form-label">月</label>
                    </div>



                    <div class="col-lg-6 mb-4">
                        <label for="postal" class="form-label">郵便番号</label>
                        <input type="text" class="form-control" maxlength=7  name="postal" placeholder="ハイフンなし" value="<?= $result['postal'] ?>">
                    </div>
                    <div class="col-12 pb-4">
                        <label for="address01" class="form-label">住所①</label>
                        <input type="text" class="form-control" maxlength=30  name="address01" placeholder="" value="<?= $result['address01'] ?>">
                    </div>
                    <div class="col-12 pb-4">
                        <label for="address02" class="form-label">住所①</label>
                        <input type="text" class="form-control" maxlength=30  name="address02" placeholder="" value="<?= $result['address02'] ?>">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="phone" class="form-label">電話</label>
                        <input type="text" class="form-control" maxlength=1o  name="phone" placeholder="00-0000-0000" value="<?= $result['phone'] ?>">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="fax" class="form-label">FAX</label>
                        <input type="text" class="form-control" maxlength=10  name="fax" placeholder="00-0000-0000" value="<?= $result['fax'] ?>">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="url" class="form-label">HP</label>
                        <input type="url" class="form-control" maxlength=30  name="url" placeholder="www.xxxx.com" value="<?= $result['url'] ?>">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="email" class="form-label">Eメール</label>
                        <input type="email" class="form-control" maxlength=50  name="email" placeholder="xxxxxx@yyy.co.jp" value="<?= $result['email'] ?>">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="mobile" class="form-label">携帯</label>
                        <input type="text" class="form-control" maxlength=11  name="mobile" placeholder="000-0000-0000" value="<?= $result['mobile'] ?>">
                    </div>

                    <div class="col-12 pb-4">
                        <!-- <label for="catch_phrase_on" class="form-label">休日の私をひとことで！</label> -->
                        <h4 class="pb-2">私のキャッチコピーをひとことで！</h4>
                        <input type="text" class="form-control" maxlength=20  name="catch_phrase_on" placeholder="" value="<?= $result['catch_phrase_on'] ?>">
                    </div>


                <a type="button" id="go_to_profileOn_02" class="w-100 btn btn-primary mt-4 mb-5">次へ</a>

          </div>
        </section>


        <section id="profileOn_02">
            <div class="pb-3 text-center">
            <p class="lead">2 / 3</p>
            </div>

            <p class="lead py-3">■出身大学</p>

          <div class="row g-3">      
            <div class="col-lg-6 mb-4">
              <label for="univ" class="form-label">大学</label>
              <input type="text" class="form-control" maxlength=20  name="univ" placeholder="" value="<?= $result['univ'] ?>">
            </div>
            <div class="col-lg-6 mb-4">
              <label for="univ_major" class="form-label">学部・学科</label>
              <input type="text" class="form-control" maxlength=20  name="univ_major" placeholder="" value="<?= $result['univ_major'] ?>">
            </div>
            <div class="form-group row mb-4">
              <label for="univ_start_year" class="form-label">期間</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="univ_start_year" placeholder="西暦" value="<?= $result['univ_start_year'] ?>">
              </div>
              <label for="univ_start_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="univ_start_month" placeholder="月" value="<?= $result['univ_start_month'] ?>">
              </div>
              <label for="univ_start_month" class="col-lg-2 col-form-label">月 ～</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="univ_end_year" placeholder="西暦" value="<?= $result['univ_end_year'] ?>">
              </div>
              <label for="univ_end_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="univ_end_month" placeholder="月" value="<?= $result['univ_end_month'] ?>">
              </div>
                <label for="univ_end_month" class="col-lg-2 col-form-label">月</label>
            </div> 
            <div class="col-12 pb-4">
                <label for="univ_detail" class="form-label">主な活動</label>
                <input type="text" class="form-control" name="univ_detail" placeholder="" value="<?= $result['univ_detail'] ?>">
            </div>

            <p class="lead py-3">■出身高校</p>

            <div class="col-lg-6 mb-4">
              <label for="hs" class="form-label">高校</label>
              <input type="text" class="form-control" maxlength=20  name="hs" placeholder="" value="<?= $result['hs'] ?>">
            </div>
            <div class="col-lg-6 mb-4">
              <label for="hs_major" class="form-label">学科</label>
              <input type="text" class="form-control" maxlength=20  name="hs_major" placeholder="" value="<?= $result['hs_major'] ?>">
            </div>
            <div class="form-group row mb-4">
              <label for="hs_start_year" class="form-label">期間</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="hs_start_year" placeholder="西暦" value="<?= $result['hs_start_year'] ?>">
              </div>
              <label for="hs_start_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="hs_start_month" placeholder="月" value="<?= $result['hs_start_month'] ?>">
              </div>
              <label for="hs_start_month" class="col-lg-2 col-form-label">月 ～</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="hs_end_year" placeholder="西暦" value="<?= $result['hs_end_year'] ?>">
              </div>
              <label for="hs_end_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="hs_end_month" placeholder="月" value="<?= $result['hs_end_month'] ?>">
              </div>
                <label for="hs_end_month" class="col-lg-2 col-form-label">月</label>
            </div> 
            <div class="col-12 pb-4">
                <label for="hs_detail" class="form-label">主な活動</label>
                <input type="text" class="form-control" name="hs_detail" placeholder="" value="<?= $result['hs_detail'] ?>">
            </div>

            <p class="lead py-3">■出身大学院</p>

            <div class="col-lg-6 mb-4">
              <label for="grad" class="form-label">大学院</label>
              <input type="text" class="form-control" maxlength=20  name="grad" placeholder="" value="<?= $result['grad'] ?>">
            </div>
            <div class="col-lg-6 mb-4">
              <label for="grad_major" class="form-label">研究科・専攻</label>
              <input type="text" class="form-control" maxlength=20  name="grad_major" placeholder="" value="<?= $result['grad_major'] ?>">
            </div>
            <div class="form-group row mb-4">
              <label for="grad_start_year" class="form-label">期間</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="grad_start_year" placeholder="西暦" value="<?= $result['grad_start_year'] ?>">
              </div>
              <label for="grad_start_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="grad_start_month" placeholder="月" value="<?= $result['grad_start_month'] ?>">
              </div>
              <label for="grad_start_month" class="col-lg-2 col-form-label">月 ～</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="grad_end_year" placeholder="西暦" value="<?= $result['grad_end_year'] ?>">
              </div>
              <label for="grad_end_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="grad_end_month" placeholder="月" value="<?= $result['grad_end_month'] ?>">
              </div>
                <label for="grad_end_month" class="col-lg-2 col-form-label">月</label>
            </div> 
            <div class="col-12 pb-4">
                <label for="grad_detail" class="form-label">主な活動</label>
                <input type="text" class="form-control" name="grad_detail" placeholder="" value="<?= $result['grad_detail'] ?>">
            </div>
        

            <p class="lead py-3">■職歴（1）</p>

            <div class="col-lg-6 mb-4">
              <label for="career01" class="form-label">会社名</label>
              <input type="text" class="form-control" maxlength=20  name="career01" placeholder="" value="<?= $result['career01'] ?>">
            </div>
            <div class="col-lg-6 mb-4">
              <label for="division01" class="form-label">部署名</label>
              <input type="text" class="form-control" maxlength=20  name="division01" placeholder="" value="<?= $result['division01'] ?>">
            </div>
            <div class="form-group row mb-4">
              <label for="career01_start_year" class="form-label">期間</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="career01_start_year" placeholder="西暦" value="<?= $result['career01_start_year'] ?>">
              </div>
              <label for="career01_start_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="career01_start_month" placeholder="月" value="<?= $result['career01_start_month'] ?>">
              </div>
              <label for="career01_start_month" class="col-lg-2 col-form-label">月 ～</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="career01_end_year" placeholder="西暦" value="<?= $result['career01_end_year'] ?>">
              </div>
              <label for="career01_end_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="career01_end_month" placeholder="月" value="<?= $result['career01_end_month'] ?>">
              </div>
                <label for="career01_end_month" class="col-lg-2 col-form-label">月</label>
            </div> 
            <div class="col-12 pb-4">
                <label for="career01_detail" class="form-label">主な活動</label>
                <input type="text" class="form-control" name="career01_detail" placeholder="" value="<?= $result['career01_detail'] ?>">
            </div>


            <p class="lead py-3">■職歴（2）</p>

            <div class="col-lg-6 mb-4">
              <label for="career02" class="form-label">会社名</label>
              <input type="text" class="form-control" maxlength=20  name="career02" placeholder="" value="<?= $result['career02'] ?>">
            </div>
            <div class="col-lg-6 mb-4">
              <label for="division02" class="form-label">部署名</label>
              <input type="text" class="form-control" maxlength=20  name="division02" placeholder="" value="<?= $result['division02'] ?>">
            </div>
            <div class="form-group row mb-4">
              <label for="career02_start_year" class="form-label">期間</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="career02_start_year" placeholder="西暦" value="<?= $result['career02_start_year'] ?>">
              </div>
              <label for="career02_start_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="career02_start_month" placeholder="月" value="<?= $result['career02_start_month'] ?>">
              </div>
              <label for="career02_start_month" class="col-lg-2 col-form-label">月 ～</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="career02_end_year" placeholder="西暦" value="<?= $result['career02_end_year'] ?>">
              </div>
              <label for="career02_end_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="career02_end_month" placeholder="月" value="<?= $result['career02_end_month'] ?>">
              </div>
                <label for="career02_end_month" class="col-lg-2 col-form-label">月</label>
            </div> 
            <div class="col-12 pb-4">
                <label for="career02_detail" class="form-label">主な活動</label>
                <input type="text" class="form-control" name="career02_detail" placeholder="" value="<?= $result['career02_detail'] ?>">
            </div>

            <p class="lead py-3">■職歴（3）</p>

            <div class="col-lg-6 mb-4">
              <label for="career03" class="form-label">会社名</label>
              <input type="text" class="form-control" maxlength=20  name="career03" placeholder="" value="<?= $result['career03'] ?>">
            </div>
            <div class="col-lg-6 mb-4">
              <label for="division03" class="form-label">部署名</label>
              <input type="text" class="form-control" maxlength=20  name="division03" placeholder="" value="<?= $result['division03'] ?>">
            </div>
            <div class="form-group row mb-4">
              <label for="career03_start_year" class="form-label">期間</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="career03_start_year" placeholder="西暦" value="<?= $result['career03_start_year'] ?>">
              </div>
              <label for="career03_start_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="career03_start_month" placeholder="月" value="<?= $result['career03_start_month'] ?>">
              </div>
              <label for="career03_start_month" class="col-lg-2 col-form-label">月 ～</label>
              <div class="col-lg-2"> 
                <input type="text" class="form-control" maxlength=4  name="career03_end_year" placeholder="西暦" value="<?= $result['career03_end_year'] ?>">
              </div>
              <label for="career03_end_year" class="col-lg-1 col-form-label">年</label>
              <div class="col-lg-1"> 
                <input type="text" class="form-control" maxlength=2  name="career03_end_month" placeholder="月" value="<?= $result['career03_end_month'] ?>">
              </div>
                <label for="career03_end_month" class="col-lg-2 col-form-label">月</label>
            </div> 
            <div class="col-12 pb-4">
                <label for="career03_detail" class="form-label">主な活動</label>
                <input type="text" class="form-control" name="career03_detail" placeholder="" value="<?= $result['career03_detail'] ?>">
            </div>

                <a type="button" id="back_to_profileOn_01" class="w-100 btn btn-secondary mt-4 mb-1">戻る</a>
                <a type="button" id="go_to_profileOn_03" class="w-100 btn btn-primary mt-4 mb-5">次へ</a>

          </div>
        </section>


        <section id="profileOn_03">
            <div class="pb-3 text-center">
            <p class="lead">3 / 3</p>
            </div>

            <p class="lead py-5">■私のモチベ(最大３つ)</p>

          <div class="row g-3">      

                  <div class="form-group row">
                    <div class="col-lg-4 mb-4">
                        <label for="" class="form-label">【 貢  献 】</label>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation01" value="【 貢  献 】 誰かの笑顔を見ること" onclick="click_cb();" <?php if ($result['motiv01'] == "【 貢  献 】 誰かの笑顔を見ること" || $result['motiv02'] == "【 貢  献 】 誰かの笑顔を見ること" || $result['motiv03'] == "【 貢  献 】 誰かの笑顔を見ること") echo 'checked'; ?>><label class="form-check-label" for="motivation01">誰かの笑顔を見ること</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation02" value="【 貢  献 】 誰かの役に立てること" onclick="click_cb();" <?php if ($result['motiv01'] == "【 貢  献 】 誰かの役に立てること" || $result['motiv02'] == "【 貢  献 】 誰かの役に立てること" || $result['motiv03'] == "【 貢  献 】 誰かの役に立てること") echo 'checked'; ?>><label class="form-check-label" for="motivation02">誰かの役に立てること</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation03" value="【 貢  献 】 誰かを影で支えること" onclick="click_cb();" <?php if ($result['motiv01'] == "【 貢  献 】 誰かを影で支えること" || $result['motiv02'] == "【 貢  献 】 誰かを影で支えること" || $result['motiv03'] == "【 貢  献 】 誰かを影で支えること") echo 'checked'; ?>><label class="form-check-label" for="motivation03">誰かを影で支えること</label></div>
                    </div>    
                    <div class="col-lg-4 mb-4">
                        <label for="" class="form-label">【 スキル 】</label>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation04" value="【 スキル 】 知識やスキルが身に着くこと" onclick="click_cb();" <?php if ($result['motiv01'] == "【 スキル 】 知識やスキルが身に着くこと" || $result['motiv02'] == "【 スキル 】 知識やスキルが身に着くこと" || $result['motiv03'] == "【 スキル 】 知識やスキルが身に着くこと") echo 'checked'; ?>><label class="form-check-label" for="motivation04">知識やスキルが身に着くこと</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation05" value="【 スキル 】 答えや解決策を見つけ出すこと" onclick="click_cb();" <?php if ($result['motiv01'] == "【 スキル 】 答えや解決策を見つけ出すこと" || $result['motiv02'] == "【 スキル 】 答えや解決策を見つけ出すこと" || $result['motiv03'] == "【 スキル 】 答えや解決策を見つけ出すこと") echo 'checked'; ?>><label class="form-check-label" for="motivation05">答えや解決策を見つけ出すこと</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation06" value="【 スキル 】 何かを表現・創造すること" onclick="click_cb();" <?php if ($result['motiv01'] == "【 スキル 】 何かを表現・創造すること" || $result['motiv02'] == "【 スキル 】 何かを表現・創造すること" || $result['motiv03'] == "【 スキル 】 何かを表現・創造すること") echo 'checked'; ?>><label class="form-check-label" for="motivation06">何かを表現・創造すること</label></div>
                    </div>    
                    <div class="col-lg-4 mb-4">
                        <label for="" class="form-label">【 協  力 】</label>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation07" value="【 協  力 】 リーダーシップを発揮すること" onclick="click_cb();" <?php if ($result['motiv01'] == "【 協  力 】 リーダーシップを発揮すること" || $result['motiv02'] == "【 協  力 】 リーダーシップを発揮すること" || $result['motiv03'] == "【 協  力 】 リーダーシップを発揮すること") echo 'checked'; ?>><label class="form-check-label" for="motivation07">リーダーシップを発揮すること</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation08" value="【 協  力 】 みんなで協力して取り組むこと" onclick="click_cb();" <?php if ($result['motiv01'] == "【 協  力 】 みんなで協力して取り組むこと" || $result['motiv02'] == "【 協  力 】 みんなで協力して取り組むこと" || $result['motiv03'] == "【 協  力 】 みんなで協力して取り組むこと") echo 'checked'; ?>><label class="form-check-label" for="motivation08">みんなで協力して取り組むこと</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation09" value="【 協  力 】 チームをサポートすること" onclick="click_cb();" <?php if ($result['motiv01'] == "【 協  力 】 チームをサポートすること" || $result['motiv02'] == "【 協  力 】 チームをサポートすること" || $result['motiv03'] == "【 協  力 】 チームをサポートすること") echo 'checked'; ?>><label class="form-check-label" for="motivation09">チームをサポートすること</label></div>
                    </div>    
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-4 mb-4">
                        <label for="" class="form-label">【 成  長 】</label>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation10" value="【 成  長 】 結果に向けて努力をすること" onclick="click_cb();" <?php if ($result['motiv01'] == "【 成  長 】 結果に向けて努力をすること" || $result['motiv02'] == "【 成  長 】 結果に向けて努力をすること" || $result['motiv03'] == "【 成  長 】 結果に向けて努力をすること") echo 'checked'; ?>><label class="form-check-label" for="motivation10">結果に向けて努力をすること</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation11" value="【 成  長 】 新たなチャレンジをすること" onclick="click_cb();" <?php if ($result['motiv01'] == "【 成  長 】 新たなチャレンジをすること" || $result['motiv02'] == "【 成  長 】 新たなチャレンジをすること" || $result['motiv03'] == "【 成  長 】 新たなチャレンジをすること") echo 'checked'; ?>><label class="form-check-label" for="motivation11">新たなチャレンジをすること</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation12" value="【 成  長 】 最後までやり抜くこと" onclick="click_cb();" <?php if ($result['motiv01'] == "【 成  長 】 最後までやり抜くこと" || $result['motiv02'] == "【 成  長 】 最後までやり抜くこと" || $result['motiv03'] == "【 成  長 】 最後までやり抜くこと") echo 'checked'; ?>><label class="form-check-label" for="motivation12">最後までやり抜くこと</label></div>
                    </div>    
                    <div class="col-lg-4 mb-4">
                        <label for="" class="form-label">【 競  争 】</label>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation13" value="【 競  争 】 売上や顧客を増やすこと" onclick="click_cb();" <?php if ($result['motiv01'] == "【 競  争 】 売上や顧客を増やすこと" || $result['motiv02'] == "【 競  争 】 売上や顧客を増やすこと" || $result['motiv03'] == "【 競  争 】 売上や顧客を増やすこと") echo 'checked'; ?>><label class="form-check-label" for="motivation13">売上や顧客を増やすこと</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation14" value="【 競  争 】 ライバルに打ち勝つこと" onclick="click_cb();" <?php if ($result['motiv01'] == "【 競  争 】 ライバルに打ち勝つこと" || $result['motiv02'] == "【 競  争 】 ライバルに打ち勝つこと" || $result['motiv03'] == "【 競  争 】 ライバルに打ち勝つこと") echo 'checked'; ?>><label class="form-check-label" for="motivation14">ライバルに打ち勝つこと</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation15" value="【 競  争 】 駆け引きや交渉すること" onclick="click_cb();" <?php if ($result['motiv01'] == "【 競  争 】 駆け引きや交渉すること" || $result['motiv02'] == "【 競  争 】 駆け引きや交渉すること" || $result['motiv03'] == "【 競  争 】 駆け引きや交渉すること") echo 'checked'; ?>><label class="form-check-label" for="motivation15">駆け引きや交渉すること</label></div>
                    </div>    
                    <div class="col-lg-4 mb-4">
                        <label for="" class="form-label">【  獲  得 】</label>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation16" value="【 獲  得 】 何かを手に入れること" onclick="click_cb();" <?php if ($result['motiv01'] == "【 獲  得 】 何かを手に入れること" || $result['motiv02'] == "【 獲  得 】 何かを手に入れること" || $result['motiv03'] == "【 獲  得 】 何かを手に入れること") echo 'checked'; ?>><label class="form-check-label" for="motivation16">何かを手に入れること</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation17" value="【 獲  得 】 地位や年収が上がること" onclick="click_cb();" <?php if ($result['motiv01'] == "【 獲  得 】 地位や年収が上がること" || $result['motiv02'] == "【 獲  得 】 地位や年収が上がること" || $result['motiv03'] == "【 獲  得 】 地位や年収が上がること") echo 'checked'; ?>><label class="form-check-label" for="motivation17">地位や年収が上がること</label></div>
                        <div class="form-check"><input type="checkbox" name="motiv[]" class="form-check-input" id="motivation18" value="【 獲  得 】 新たな人間関係を築くこと" onclick="click_cb();" <?php if ($result['motiv01'] == "【 獲  得 】 新たな人間関係を築くこと" || $result['motiv02'] == "【 獲  得 】 新たな人間関係を築くこと" || $result['motiv03'] == "【 獲  得 】 新たな人間関係を築くこと") echo 'checked'; ?>><label class="form-check-label" for="motivation18">新たな人間関係を築くこと</label></div>
                    </div>    
                  </div>
                


                  <p class="lead py-3">■私のエピソード</p>

                    <div class="col-lg-6">
                    <select class="form-select" name="episode">
                        <option value="" <?php if ($result['episode'] == "") echo 'selected'; ?>>内容を選択</option>
                            <option value="過去にこんな大失敗をしました！" <?php if ($result['episode'] == "過去にこんな大失敗をしました！") echo 'selected'; ?>>過去にこんな大失敗をしました！</option>    
                            <option value="過去にこんな大成功をしました！" <?php if ($result['episode'] == "過去にこんな大成功をしました！") echo 'selected'; ?>>過去にこんな大成功をしました！</option>
                            <option value="実はこんな経験があります！" <?php if ($result['episode'] == "実はこんな経験があります！") echo 'selected'; ?>>実はこんな経験があります！</option>
                            <option value="実はこんな夢を持っています！" <?php if ($result['episode'] == "実はこんな夢を持っています！") echo 'selected'; ?>>実はこんな夢を持っています！</option>
                            <option value="実はこんなことに興味があります！" <?php if ($result['episode'] == "実はこんなことに興味があります！") echo 'selected'; ?>>実はこんなことに興味があります！</option>
                            <option value="実はこんな特技があります！" <?php if ($result['episode'] == "実はこんな特技があります！") echo 'selected'; ?>>実はこんな特技があります！</option>
                    </select>
                    </div>


                    <div class="col-12 mb-4">
                        <textarea rows="4" class="form-control"  maxlength=200 id="js_episode" name="episode_detail" placeholder="200文字以内"><?= $result['episode_detail'] ?></textarea>
                    </div>



                    <a type="button" id="back_to_profileOn_02" class="w-100 btn btn-secondary mt-4 mb-5">戻る</a>

                    <hr class="my-4">

                    <button type="submit" id="submit" class="w-100 btn btn-primary btn-lg mt-5">Submit / 登録する</button>

           </div>
        </section>
    
        <a type="button" class="w-100 btn btn-outline-secondary mt-4 mb-5" onclick="location.href='top.php'">Back to TOP / トップに戻る &raquo;</a>

    </form>

   
    
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<script>

// 画面遷移

$('#profileOn_01').show();
$('#profileOn_02').hide();
$('#profileOn_03').hide();

$("#go_to_profileOn_02").on('click',function(){
    $('#profileOn_01').toggle();  //hide
    $('#profileOn_02').toggle();  //show
    $("html,body").scrollTop(0); // 画面の一番上にスクロール
    // $('#forMyTeam').hide();
});

$("#back_to_profileOn_01").on('click',function() {
    $('#profileOn_01').toggle();  //show
    $('#profileOn_02').toggle();  // hide
    // $('#forMyTeam').hide();
    $("html,body").scrollTop(0); // 画面の一番上にスクロール
});

$("#go_to_profileOn_03").on('click',function() {
    // $('#forMyColleague').hide();
    $('#profileOn_02').toggle();  //hide
    $('#profileOn_03').toggle();  //show
    $("html,body").scrollTop(0); // 画面の一番上にスクロール
});

$("#back_to_profileOn_02").on('click',function(){
    // $('#forMyColleague').hide();
    $('#profileOn_02').toggle();  //show
    $('#profileOn_03').toggle();  //hide
    $("html,body").scrollTop(0); // 画面の一番上にスクロール
});



// 年月のプルダウン作成
// function SelectBoxCreate(start, end){
//     let str = "";
//     for(let i=start; i<end; i++){
//         str += `<option>${i}</option>`;
//     }
//     return str;
// }

// const month = SelectBoxCreate(1,13);
// const year = SelectBoxCreate(1923,2024);

// $("#js_birth_year").html(year);    
// $("#js_birth_month").html(month);    

// $("#js_start_year").html(year);    
// $("#js_start_month").html(month);    

// $("#js_univ_start_year").html(year);    
// $("#js_univ_start_month").html(month);    
// $("#js_hs_start_year").html(year);    
// $("#js_hs_start_month").html(month);    
// $("#js_grad_start_year").html(year);    
// $("#js_grad_start_month").html(month);    
// $("#js_career01_start_year").html(year);    
// $("#js_career01_start_month").html(month);    
// $("#js_career02_start_year").html(year);    
// $("#js_career02_start_month").html(month);    
// $("#js_career03_start_year").html(year);    
// $("#js_career03_start_month").html(month);    

// $("#js_univ_end_year").html(year);    
// $("#js_univ_end_month").html(month);    
// $("#js_hs_end_year").html(year);    
// $("#js_hs_end_month").html(month);    
// $("#js_grad_end_year").html(year);    
// $("#js_grad_end_month").html(month);    
// $("#js_career01_end_year").html(year);    
// $("#js_career01_end_month").html(month);    
// $("#js_career02_end_year").html(year);    
// $("#js_career02_end_month").html(month);    
// $("#js_career03_end_year").html(year);    
// $("#js_career03_end_month").html(month);    



//  【 出身地 】  国内→リスト選択  海外→テキスト入力

// $(document).ready(function() {

//     $('#js_born_overseas').hide();
//     $('#js_born_domestic').hide();
    
// $(function() {
//     $('[name="born_place"]:radio').change( function() {
//       if($('[id=js_domestic]').prop('checked')){
//         $('#js_born_overseas').hide();
//         $('#js_born_domestic').toggle(); //show
//         } else if ($('[id=js_overseas]').prop('checked')) {
//             $('#js_born_overseas').toggle(); //show
//             $('#js_born_domestic').hide();
//         } 
//    });
// });



//   【 職業 】  詳細入力  選択項目で表示・非表示

        // $('#js_company_name').hide();
        // $('#js_business_name').hide();
        // $('#js_school_name').hide();
        // $('#js_others_name').hide();
        // $('#js_start').hide();


// $(function() {
//     $('#js-occupation').change( function() {

//         if($('[id=js_business_person]').prop('selected')||$('[id=js_part_timer]').prop('selected')||$('[id=js_company_executive]').prop('selected')){
//         $('#js_company_name').show(); 
//         $('#js_business_name').hide();
//         $('#js_school_name').hide();
//         $('#js_start').show();

//     } else if ($('[id=js_freelance]').prop('selected')||$('[id=js_professional]').prop('selected')) {
//         $('#js_company_name').hide();
//         $('#js_business_name').show();
//         $('#js_school_name').hide();
//         $('#js_start').show();

//     } else if ($('[id=js_student]').prop('selected')) {
//         $('#js_company_name').hide();
//         $('#js_business_name').hide();
//         $('#js_school_name').show();
//         $('#js_start').show();

//     } else if ($('[id=js_house_person]').prop('selected')||$('[id=js_other_person]').prop('selected')||$('[id=js_occupation_blanc]').prop('selected')) {
//         $('#js_company_name').hide();
//         $('#js_business_name').hide();
//         $('#js_school_name').hide();
//         $('#js_start').hide();

//     } else{
//         $('#js_company_name').hide();
//         $('#js_business_name').hide();
//         $('#js_school_name').hide();
//         $('#js_start').hide();
    
//     };
//     });
// });


//   【 職業 】  詳細入力  選択項目で表示・非表示

        $('#js_company_name').hide(); 
        $('#js_business01_name').hide();
        $('#js_school_name').hide();
        $('#js_affiliation').hide();
        $('#js_division_name').hide(); 
        $('#js_business02_name').hide();
        $('#js_department_name').hide();
        $('#js_division').hide();
        $('#js_company_start').hide(); 
        $('#js_business_start').hide();
        $('#js_school_start').hide();
        $('#js_start').hide();

        
$(function() {
    $('#js-occupation').change( function() {

        if($('[id=js_business_person]').prop('selected')||$('[id=js_part_timer]').prop('selected')||$('[id=js_company_executive]').prop('selected')){
        $('#js_company_name').show(); 
        $('#js_business01_name').hide();
        $('#js_school_name').hide();
        $('#js_affiliation').show();
        $('#js_division_name').show(); 
        $('#js_business02_name').hide();
        $('#js_department_name').hide();
        $('#js_division').show();
        $('#js_company_start').show(); 
        $('#js_business_start').hide();
        $('#js_school_start').hide();
        $('#js_start').show();

    } else if ($('[id=js_freelance]').prop('selected')||$('[id=js_professional]').prop('selected')) {
        $('#js_company_name').hide(); 
        $('#js_business01_name').show();
        $('#js_school_name').hide();
        $('#js_affiliation').show();
        $('#js_division_name').hide(); 
        $('#js_business02_name').show();
        $('#js_department_name').hide();
        $('#js_division').show();
        $('#js_company_start').hide()   ; 
        $('#js_business_start').show();
        $('#js_school_start').hide();
        $('#js_start').show();

    } else if ($('[id=js_student]').prop('selected')) {
        $('#js_company_name').hide(); 
        $('#js_business01_name').hide();
        $('#js_school_name').show();
        $('#js_affiliation').show();
        $('#js_division_name').hide(); 
        $('#js_business02_name').hide();
        $('#js_department_name').show();
        $('#js_division').show();
        $('#js_company_start').hide(); 
        $('#js_business_start').hide();
        $('#js_school_start').show();
        $('#js_start').show();

    } else if ($('[id=js_house_person]').prop('selected')||$('[id=js_other_person]').prop('selected')||$('[id=js_occupation_blanc]').prop('selected')) {
        $('#js_company_name').hide(); 
        $('#js_business01_name').hide();
        $('#js_school_name').hide();
        $('#js_affiliation').hide();
        $('#js_division_name').hide(); 
        $('#js_business02_name').hide();
        $('#js_department_name').hide();
        $('#js_division').hide();
        $('#js_company_start').hide(); 
        $('#js_business_start').hide();
        $('#js_school_start').hide();
        $('#js_start').hide();

    } else{
        $('#js_company_name').hide(); 
        $('#js_business01_name').hide();
        $('#js_school_name').hide();
        $('#js_affiliation').hide();
        $('#js_division_name').hide(); 
        $('#js_business02_name').hide();
        $('#js_department_name').hide();
        $('#js_division').hide();
        $('#js_company_start').hide(); 
        $('#js_business_start').hide();
        $('#js_school_start').hide(); 
        $('#js_start').hide();

    };
    });
});



// セレクトボックスの上限設定

function click_cb(){
    //チェックカウント用変数
    var check_count = 0;
    // 箇所チェック数カウント
    $(".motivation ul li").each(function(){
        var parent_checkbox = $(this).children("input[type='checkbox']");
        if(parent_checkbox.prop('checked')){
            check_count = check_count+1;
        }
    });
    // 0個のとき（チェックがすべて外れたとき）
    if(check_count == 0){
        $(".motivation ul li").each(function(){
            $(this).find(".locked").removeClass("locked");
        });
    // 3個以上の時（チェック可能上限数）
    }else if(check_count > 2){
        $(".motivation ul li").each(function(){
            // チェックされていないチェックボックスをロックする
            if(!$(this).children("input[type='checkbox']").prop('checked')){
                $(this).children("input[type='checkbox']").prop('disabled',true);
                $(this).addClass("locked");
            }
        });
    }else{
        $(".motivation ul li").each(function(){
            // チェックされていないチェックボックスを選択可能にする
            if(!$(this).children("input[type='checkbox']").prop('checked')){
                $(this).children("input[type='checkbox']").prop('disabled',false);
                $(this).removeClass("locked");
            }
        });
    }
    return false;
}



// ボタンクリックでフォームを送信

$("#submit").click(function(){

// // ※確認用※チェックボックスの値を配列に格納

// // 配列を宣言
//   var arr_motiv = [];
  
//   $('[class="motiv"]:checked').each(function(){
//       // 無効化する
//       $(this).prop('disabled', true);
   
//       // チェックされているの値を配列に格納
//       arr_motiv.push($(this).val());
//   });
//   console.log(arr_motiv);


$('#profileON').submit();

});

</script>



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>