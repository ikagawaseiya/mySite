<?php
session_start();
/**
 * jsから呼び出され、DB登録処理を行う
 */
require_once __DIR__ . '/../../Component/likeButton/likeButtonController.php';

header('Content-Type: application/json; charset=UTF-8');

try {
  //jsからファイルを受け取り
  //403エラーを回避する形式から元のURIへデコードする
  $rawInput = file_get_contents('php://input');
  $input = json_decode($rawInput, true);
  $currentUri = $input['uri'] ?? null;
  $currentUri = urldecode($currentUri);

  // 送られてきたヘッダーを取得
  $headers = getallheaders();
  $CSRFToken = isset($headers['X-CSRF-Token']) ? $headers['X-CSRF-Token'] : '';
  if ($CSRFToken !== $_SESSION['csrf_token']) {
    echo "エラー：CSRFトークン";
    exit;
  }

  if ($currentUri === "/index.php" || $currentUri === "") {
    $currentUri = "/";
  }

  $likeButtonDB = getDB();
  if (!$likeButtonDB) {
    throw new Exception('データベースの接続に失敗しました。');
  }

  $likeButtonDB->uri = $currentUri;
  $likeButtonDB->insertLike($likeButtonDB->uri);

  echo json_encode(['status' => 'success']);
  exit;
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
  exit;
}
