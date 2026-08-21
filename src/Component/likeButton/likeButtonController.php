<?php

/**
 * いいねボタンを表示する
 * 
 * フッターから呼び出している
 *
 * @return void
 */
function showLikeButton(): void
{
  //DB接続処理
  require_once __DIR__ . '/../../Model/testDBConnector.php';
  $test = new TestDBConnector;
  try {
    $test->connect();
  } catch (Exception $e) {
    echo "DB接続に失敗しました。";
  };

  $likeCount = getLikeCount();
  require_once __DIR__ . '/likeButtonView.php';
}

/**
 * TODO　いいねの数をDBから取得する処理を実装する
 * 
 * DBからページが一致する「いいね」の数を取得して、それを返す
 *
 * @return integer いいね数
 */
function getLikeCount(): int
{
  return 0;
}
