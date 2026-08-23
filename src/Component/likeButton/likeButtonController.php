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
