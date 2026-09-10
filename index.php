<?php
require_once __DIR__ . '/error-log/init.php';
ob_start();
session_start();
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

const SITE_NAME = "かわいいうさぎ";
//ルーターを起動
require_once __DIR__ . '/router.php';
$router = new Router();
$router->run();
