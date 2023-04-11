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
$stmt->bindValue(':lid', $lid, PDO::PARAM_INT);
$status = $stmt->execute();


//３．データ表示
$id = '' or
$card = '' or
$page = '' ;


if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {  
        //GETデータ送信リンク作成
        
        $id .= $result['id'];        
        $card .= './screenshot/card_id_' . $result['id'] . '.png';
        $page .= 'http://www.selfy.co.jp/card.php?id=' . $result['id'] ;

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



    // class Test {
    //     public function run()
    //     {

            // ファイルの保存場所指定
            $screenPath = $card;
            
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

            // キャプチャするページ指定
            $driver->get($page);
            
            $dimension = new WebDriverDimension(586,210); // width, height
            $driver->manage()->window()->setSize($dimension);

            // $dim_width = 190;
            // $dim_height = 80;
            // $top = 70;
            // $left = 15;

            // $width = 800;
            // $height = 600;
            // $driver->setWindowtSize($width, $height);


            // スクリーンショットを保存
            $driver->takeScreenshot($screenPath);

            // ブラウザを閉じる
            $driver->close();



              //５．send.phpへリダイレクト
            header('Location: send_card.php');
    //     }
    // }

    // $t = new Test();
    // $t->run();