<?php
/**
 * ルーターの役割を担うクラス
 * 
 * 初期設定と、URLに応じたコントローラーの呼び出しを行う
 */
class Router {
    public function run(){
// --- 1. 静的ファイル（CSS/JS）の処理 ---
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$publicDir = dirname(__FILE__);
$cleanPath = (strpos($path, '/public') === 0) ? substr($path, 7) : $path;
$targetFile = $publicDir . str_replace('/', DIRECTORY_SEPARATOR, $cleanPath);

// ファイルが実在し、かつ「.php」ファイルではない場合のみ、ファイルを出力する
if (is_file($targetFile) && file_exists($targetFile) && pathinfo($targetFile, PATHINFO_EXTENSION) !== 'php') {
    $ext = pathinfo($targetFile, PATHINFO_EXTENSION);
    if ($ext === 'css') header('Content-Type: text/css');
    if ($ext === 'js')  header('Content-Type: application/javascript');
    readfile($targetFile);
    exit; 
}

$this->loadingCommonFiles();

// --- 3. URL直打ち（トップページ以外）の自動切り替え処理 ---
$page = trim($cleanPath, '/');
// URLが空、または index.php の場合はtopPageControllerを呼び出す
if ($page === '' || $page === 'index.php') {
require_once __DIR__ . '/../src/Controller/topPageController.php';
$controller = new topPageController();
$controller->show();
    return; 
}

     // ★追加：URLが「blog/」から始まる場合のルーティング処理
        if (strpos($page, 'blog/') === 0) {
            require_once __DIR__ . '/../src/Controller/blogController.php';
            $controller = new blogController();
            // 例: blog/firstPage から「firstPage」だけを抜き出して渡す
            $articleName = substr($page, 5); 
            $controller->show($articleName);
            exit;
        }

// トップページ以外のURL（例: /profile）が指定された場合、対応するコントローラーを呼び出す
$controllerFile = __DIR__ . '/../src/Controller/' . $page . 'Controller.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = $page . 'Controller';
    if (class_exists($className)) {
        $controller = new $className();
        $controller->show();
        exit; // 該当するページを表示して終了
    }
}

// どのファイルにもマッチしない不正なURLの場合404
header("HTTP/1.0 404 Not Found");
echo "<h1>404 Not Found</h1>ページが見つかりません。";
exit;
}

    
/*
*--- 共通ファイルの読み込み ---
*
*各種controllerを起動する前に、以下のファイルを読み込む
*汎用関数 - src/Controller/common.php
*ヘッダー - src/Component/header.php
*
*/
public function loadingCommonFiles() {
$commonFile = __DIR__ . '/../src/Controller/common.php';
if (file_exists($commonFile)) {
    require_once $commonFile;
}
$headerFile = __DIR__ . '/../src/Component/header.php';
if (file_exists($headerFile)) {
    require_once $headerFile;
}
}
}