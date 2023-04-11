    <?php
    require_once('./vendor/autoload.php');

    use Facebook\WebDriver;
    use Facebook\WebDriver\WebDriverExpectedCondition;
    use Facebook\WebDriver\WebDriverBy;
    use Facebook\WebDriver\Chrome\ChromeOptions;
    use Facebook\WebDriver\Chrome\ChromeDriver;
    use Facebook\WebDriver\Remote\DesiredCapabilities;

    class Test {
        public function run()
        {
            $screenPath = './screenshot/screenshot.png';

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

            $driver->get('http://www.yahoo.co.jp/');
            
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