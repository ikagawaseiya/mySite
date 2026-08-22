<?php

/**
 * いいねボタンを表示する
 * 表示する前に、いいね数をDBから取得する
 * 
 * フッターから呼び出している
 *
 * @return void
 */
function showLikeButton(): void
{
  //DB接続
  $likeButtonDb = getDb();

  try {
    $likeCount = $likeButtonDb->getLikeCount();
  } catch (Exception $e) {
    $likeCount = 0;
    echo "エラー：getLikeCount";
  }

  require_once __DIR__ . '/likeButtonView.php';
}

/**
 * DB取得メソッド
 * 
 * いいねボタンに使用するDBを返す
 *
 * @return LikeButtonDb いいねボタンのDB
 */
function getDb(): LikeButtonDb
{
  $db = null;
  try {
    require_once __DIR__ . '/../../Model/likeButtonDb.php';
    $db = new LikeButtonDb;
    $db->connect();
  } catch (Exception $e) {
    echo "DB接続に失敗しました。";
  };
  return $db;
}

function setLike(LikeButtonDb $db, string $uri)
{
  $db->insertLike($uri);
}
