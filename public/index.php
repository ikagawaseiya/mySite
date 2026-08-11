<?php
// エラー表示を有効化
@ini_set('display_errors', 'On');
@error_reporting(E_ALL);
//ルーターを起動
require_once __DIR__ . '/router.php';
$router = new Router();
$router->run();