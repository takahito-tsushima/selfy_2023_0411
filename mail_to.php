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


require_once('./vendor/autoload.php');

    use Facebook\WebDriver;
    use Facebook\WebDriver\WebDriverExpectedCondition;
    use Facebook\WebDriver\WebDriverBy;
    use Facebook\WebDriver\Chrome\ChromeOptions;
    use Facebook\WebDriver\Chrome\ChromeDriver;
    use Facebook\WebDriver\Remote\DesiredCapabilities;
    use Facebook\WebDriver\WebDriverDimension;

    class Test {
        public function run()
        {
            $screenPath = './screenshot/screenshot_id' . $result['id'] . '.png';

            
            
            // ダウンロードしたchromedriverのパスを指定
            $driverPath = realpath(__DIR__ . "/chromedriver.exe");
            putenv("webdriver.chrome.driver=" . $driverPath);

            // Chromeを起動するときのオプション指定用
            $options = new ChromeOptions();

            // ヘッドレスで起動するように指定
            $options->addArguments(['--headless']);

            $caps = DesiredCapabilities::chrome();
            $caps->setCapability(ChromeOptions::CAPABILITY, $options);

            $driver = ChromeDriver::start($caps);

            $driver->get('http://www.selfy.co.jp/accept.php?id=1');
            

            $dimension = new WebDriverDimension(400, 200); // width, height
            $driver->manage()->window()->setSize($dimension);


            // $dim_width = 190;
            // $dim_height = 80;
            // $top = 70;
            // $left = 15;

            // $width = 800;
            // $height = 600;
            // $driver->setWindowtSize($width, $height);


            $dimension = new WebDriverDimension(600, 300); // width, height
            $driver->manage()->window()->setSize($dimension);


            // スクリーンショットを保存
            $driver->takeScreenshot($screenPath);

            // ブラウザを閉じる
            $driver->close();



              //５．top.phpへリダイレクト
            header('Location: top.php');
        }
    }

    $t = new Test();
    $t->run();