<?php

/**
 * ルーターの役割を担うクラス
 * 
 * 初期設定を読み込んだ後、
 * URLに応じたコントローラーの呼び出しを行う
 */
class Router
{
    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $publicDir = dirname(__FILE__);
        $cleanPath = (strpos($path, '/public') === 0) ? substr($path, 7) : $path;
        $targetFile = $publicDir . str_replace('/', DIRECTORY_SEPARATOR, $cleanPath);

        $this->checkIsCssOrJsFile($targetFile);

        $this->loadingCommonFiles();


        $page = trim($cleanPath, '/');
        $this->checkIsTopPage($page);
        $this->checkIsBlogDirectory($page);
        $this->checkIsAllBlogListPage($page);
        $this->checkIsGalleryDirectory($page);
        $main_content = ob_get_clean();

        echo "ファイルが読み込めませんでした";
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
    *汎用パス取得関数　commonPathGetter
    *ファイル関係の関数　fileGetter
    *汎用css  allPage
    *フッター用css
     */
    public function loadingCommonFiles()
    {
        $genetralFunctionFile = __DIR__ . '/src/Common/common.php';
        if (file_exists($genetralFunctionFile)) {
            require_once $genetralFunctionFile;
        } else {
            echo "読み込みエラー：汎用関数";
        }

        $headerFile = __DIR__ . '/src/Component/header.php';
        if (file_exists($headerFile)) {
            require_once $headerFile;
        } else {
            echo "読み込みエラー；ヘッダー";
        }

        $footerFile = __DIR__ .  '/src/Component/footer/footerDisplayer.php';
        if (file_exists($footerFile)) {
            require_once $footerFile;
        } else {
            echo "読み込みエラー：フッター";
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

    /**
     * ブログのページであるか確認する。
     * その場合、BlogPageControllerを呼び出す
     * 
     * @param string $page 現在のページ名
     */
    public function checkIsBlogDirectory(string $page)
    {
        if (strpos($page, 'blog/') === 0) {
            require_once __DIR__ . '/src/Controller/blogPageController.php';
            $controller = new BlogPageController();
            $articleName = substr($page, 5);
            $controller->show($articleName);
            exit;
        }
    }

    /**
     * ギャラリーのページであるか確認する。
     * その場合、GalleryPageControllerを呼び出す
     * 
     * @param string $page 現在のページ名
     */
    public function checkIsGalleryDirectory(string $page)
    {
        if (strpos($page, 'gallery/') === 0) {
            require_once __DIR__ . '/src/Controller/galleryPageController.php';
            $controller = new GalleryPageController();
            $articleName = substr($page, 8);
            $controller->show($articleName);
            exit;
        }
    }


    /**
     * ブログ一覧ページであるか確認する。
     * その場合、blogListPagePageControllerを呼び出す
     * 
     * @param string $page 現在のページ名
     */
    public function checkIsAllBlogListPage(string $page)
    {
        if (strpos($page, "blogList") !== false) {
            require_once __DIR__ . '/src/Controller/allBlogListPageController.php';
            $controller = new AllBlogListPageController();
            $controller->show();
            exit;
        }
    }

    /**
     * トップページであるか確認する。
     * その場合、topPageControllerを呼び出す
     * 
     * @param string $page 現在のページ名
     */
    public function checkIsTopPage(string $page)
    {
        if ($page === '' || $page === 'index.php') {
            require_once __DIR__ . '/src/Controller/topPageController.php';
            $controller = new topPageController();
            $controller->show();
            exit;
        }
    }
}
