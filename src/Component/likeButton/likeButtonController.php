<?php

/**
 * いいねボタンを画面に表示する
 * 表示する前に、いいね数をDBから取得する
 * 
 * フッターから呼び出している
 *
 * @return void
 */
function showLikeButton(): void
{
  //DB接続
  $likeButtonDB = getDB();

  try {
    $likeCount = $likeButtonDB->getLikeCount();
  } catch (Exception $e) {
    $likeCount = 0;
    echo "エラー：getLikeCount";
  }

  $ipAddress = $_SERVER['REMOTE_ADDR'] ?? null;

  //クッキーを取得する
  //期限は172800秒（二日とする）
  //TODO 後に使う
  $likeUserCookie = "like_user_cookie";
  if (isset($_COOKIE[$likeUserCookie])) {
    $currentUserCookie = $_COOKIE[$likeUserCookie];
  } else {
    $currentUserCookie = bin2hex(random_bytes(16));
    $numberOfSecondsInTwoDays = 172800;
    $expire_time = time() + $numberOfSecondsInTwoDays;
    setcookie($likeUserCookie, $currentUserCookie, $expire_time, "/", "", true, true);
  }

  require_once __DIR__ . '/likeButtonView.php';
}

/**
 * DB取得メソッド
 * 
 * いいねボタンに使用するDBを返す
 *
 * @return LikeButtonDB いいねボタンのDB
 */
function getDB(): LikeButtonDB
{
  $db = null;
  try {
    require_once __DIR__ . '/../../Model/likeButton/likeButtonDB.php';
    $db = new LikeButtonDB;
    $db->connect();
  } catch (Exception $e) {
    echo "DB接続に失敗しました。";
  };
  return $db;
}
