<?php
session_start();
/**
 * jsから呼び出され、DB登録処理を行う
 */
require_once __DIR__ . '/../../Component/likeButton/likeButtonController.php';

header('Content-Type: application/json; charset=UTF-8');

try {
  //jsからファイルを受け取り
  //URIは403エラーを回避する形式から元のURIへデコードする
  $rawInput = file_get_contents('php://input');
  $input = json_decode($rawInput, true);
  $ipAddress = $input['ipAddress'] ?? null;
  $likeUserCookie = $input['likeUserCookie'] ?? null;
  $todayDateYMD = $input['todayDateYMD'] ?? null;
  $currentUri = $input['uri'] ?? null;
  $currentUri = urldecode($currentUri);

  $CSRFToken = $input['csrfToken'] ?? '';
  if ($CSRFToken !== $_SESSION['csrf_token']) {
    echo json_encode(['status' => 'error', 'message' => 'CSRFトークンが一致しません。']);
    http_response_code(403);
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
  $likeErrorMessage = $likeButtonDB->checkInsertLike($likeButtonDB->uri, $ipAddress, $likeUserCookie, $todayDateYMD);

  if ($likeErrorMessage !== "") {
    echo json_encode([
      'status' => 'like_daily_limit',
      'message' => $likeErrorMessage
    ]);
    exit;
  }

  echo json_encode(['status' => 'success']);
  exit;
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
  exit;
}
