<?php

/**
 * ルーターの役割を担うクラス
 * 
 * 初期設定と、URLに応じたコントローラーの呼び出しを行う
 */
class Router
{
    public function run()
    {
        // --- 静的ファイル（CSS/JS）の処理 ---
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $publicDir = dirname(__FILE__);
        $cleanPath = (strpos($path, '/public') === 0) ? substr($path, 7) : $path;
        $targetFile = $publicDir . str_replace('/', DIRECTORY_SEPARATOR, $cleanPath);
        $this->checkIsCssOrJsFile($targetFile);

        $this->loadingCommonFiles();

        $page = trim($cleanPath, '/');
        $this->checkIsTopPage($page);
        $this->checkIsBlogDirectory($page);
        $this->checkIsExistingPage($page);

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
    *汎用関数 - src/Controller/common.php
    *ヘッダー - src/Component/header.php 
     */
    public function loadingCommonFiles()
    {
        $commonFile = __DIR__ . '/src/Controller/common.php';
        if (file_exists($commonFile)) {
            require_once $commonFile;
        } else {
            echo "読み込みエラーです。";
        }
        $headerFile = __DIR__ . '/src/Component/header.php';
        if (file_exists($headerFile)) {
            require_once $headerFile;
        } else {
            echo "読み込みエラーです。";
        }
    }

    /**
     * ブログのページであるか確認する。
     * その場合、blogControllerを呼び出す
     * 
     * @param string $page 現在のページ名
     */
    public function checkIsBlogDirectory(string $page)
    {
        if (strpos($page, 'blog/') === 0) {
            require_once __DIR__ . '/src/Controller/blogController.php';
            $controller = new blogController();
            $articleName = substr($page, 5);
            $controller->show($articleName);
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

    /**
     * 既存のページであるか確認する。
     * その場合、対応するコントローラーを呼び出す
     * 
     * @param string $page 現在のページ名
     */
    public function checkIsExistingPage(string $page)
    {
        $controllerFile = __DIR__ . '/src/Controller/' . $page . 'Controller.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $className = $page . 'Controller';
            if (class_exists($className)) {
                $controller = new $className();
                $controller->show();
                exit;
            }
        }
    }
}
