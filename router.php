<?php

/**
 * ルーターの役割を担うクラス
 * 
 * 対象がCSSまたはJsファイルであればそのまま読み込む
 * そうでない場合、初期設定を読み込んだ後、
 * ページに応じたコントローラーの呼び出しを行う
 */
class Router
{
    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $publicDir = dirname(__FILE__);
        $publicStrDeleteDeletePath = (strpos($path, '/public') === 0) ? substr($path, 7) : $path;
        $targetFile = $publicDir . str_replace('/', DIRECTORY_SEPARATOR, $publicStrDeleteDeletePath);

        $this->checkIsCssOrJsFile($targetFile);

        $this->loadingCommonFiles();

        $page = trim($publicStrDeleteDeletePath, '/');
        require_once __DIR__ . '/routeChecker.php';
        $routeChecker = new RouteChecker();
        $routeChecker->routeCheck($page);

        //※例外処理
        echo "エラー：router";
        Common::show404();
    }

    /**
     * CSSまたはJSファイルであるか確認し、該当する場合はそのファイルを読み込む
     * 
     * @param string $targetFile 読み込む対象のファイルパス
     */
    public function checkIsCssOrJsFile(string $targetFile)
    {
        if (is_file($targetFile) && file_exists($targetFile) && pathinfo($targetFile, PATHINFO_EXTENSION) !== 'php') {
            $ext = pathinfo($targetFile, PATHINFO_EXTENSION);
            if ($ext === 'css') header('Content-Type: text/css');
            if ($ext === 'js')  header('Content-Type: application/javascript');
            readfile($targetFile);
            exit;
        }
    }

    /*
    *初期設定を読み込む
    *各種controllerを起動する前に、以下のファイルを読み込む
    *汎用関数  common
    *ヘッダー  header
    *フッター　footer
    *いいねボタン likeButton
    *汎用パス取得関数　commonPathGetter
    *ファイル関係の関数　fileGetter
    *汎用css  allPage
    *フッター用css
     */
    public function loadingCommonFiles()
    {

        $commonFunctionFile = __DIR__ . '/src/Common/common.php';
        if (file_exists($commonFunctionFile)) {
            require_once $commonFunctionFile;
        } else {
            echo "読み込みエラー：汎用関数";
        }

        $headerFile = __DIR__ . '/src/Component/header/headerController.php';
        if (file_exists($headerFile)) {
            require_once $headerFile;
        } else {
            echo "読み込みエラー；ヘッダー";
        }

        $footerFile = __DIR__ .  '/src/Component/footer/footerController.php';
        if (file_exists($footerFile)) {
            require_once $footerFile;
        } else {
            echo "読み込みエラー：フッター";
        }

        $likeButtonFile = __DIR__ . '/src/Component/likeButton/likeButtonController.php';
        if (file_exists($likeButtonFile)) {
            require_once  $likeButtonFile;
        } else {
            echo "読み込みエラー：いいねボタン";
        }

        $commonPathGetterFile = __DIR__ . '/src/Common/getter/fileGetter.php';
        if (file_exists($commonPathGetterFile)) {
            require_once $commonPathGetterFile;
        } else {
            echo "読み込みエラー：ファイル取得関数";
        }

        $PathGetterFile = __DIR__ . '/src/Common/getter/pathGetter.php';
        if (file_exists($PathGetterFile)) {
            require_once $PathGetterFile;
        } else {
            echo "読み込みエラー：ブログパス取得関数";
        }

        echo '<link rel="stylesheet" href="/public/css/allPage.css">';
        echo '<link rel="stylesheet" href="/public/css/footer.css">';
    }
}
