<?php

/**
 * jsから呼び出され、DB登録処理を行う
 */
require_once __DIR__ . '/../../Component/likeButton/likeButtonController.php';

header('Content-Type: application/json; charset=UTF-8');

try {
  $rawInput = file_get_contents('php://input');
  $input = json_decode($rawInput, true);
  $currentUri = $input['uri'] ?? null;

  if ($currentUri === "/index.php" || $currentUri === "") {
    $currentUri = "/"; //
  }

  $likeButtonDB = getDB();
  if (!$likeButtonDB) {
    throw new Exception('データベースの接続に失敗しました。');
  }

  $likeButtonDB->uri = $currentUri;
  $likeButtonDB->insertLike($likeButtonDB->uri);

  return true;
} catch (Exception $e) {
  return false;
}
