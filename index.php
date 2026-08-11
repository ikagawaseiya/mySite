<?php
// index.php

// コントローラーを読み込んで実行する
require_once 'Controller/topPageController.php';

$controller = new topPageController();
$controller->show();