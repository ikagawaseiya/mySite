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

  $likeCookieValue = creatCookie();

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

/**
 *乱数により生成した値をcookieに格納する
 *その後、生成した値をStringで返す
 *期限は二日（172800秒）とする
 *
 *$userCookieに$_COOKIE[$likeUserCookie]と同じ値が代入されている
 *今後の処理は$userCookieを使用すること
 *※初回のアクセス時はsetcookieが反映されないため
 *
 * @return string 乱数によって生成された$_COOKIE[$likeUserCookie]と同じ値
 */
function creatCookie(): string
{
  $likeUserCookie = "like_user_cookie";
  if (isset($_COOKIE[$likeUserCookie])) {
    return $_COOKIE[$likeUserCookie];
  } else {
    //cookieeikooccを生成
    $randomLikeCookieValue = bin2hex(random_bytes(16));
    $twoDaysSeconds = 172800;
    $aliveTime = time() + $twoDaysSeconds;
    setcookie($likeUserCookie, $randomLikeCookieValue, $aliveTime, "/", "", true, true);
  }
  return $randomLikeCookieValue;
}
