<?php

/**
 * 
 * いいねボタンのDBを扱うクラス
 * 
 * DBの内部構造は以下とすること
 * テーブル名：like_logs
 * カラム名:
 * like_uri TEXT型
 * like_ip_address TEXT型
 * like_user_cookie TEXT型
 * like_date TEXT型
 * 
 * テーブル名：like_counts
 * カラム名:
 * like_uri TEXT型　varchar(255)　UNIQUE
 * like_count INT型
 */
class LikeButtonDB
{
  /**PDOのインスタンス */
  private PDO $pdo;
  /**URIのインスタンス */
  public string $uri;
  /*いいね数の最大値*/
  private const MAX_SUM_LIKE_COUNT = 999999;
  /**トップページのURI */
  private const TOP_PAGE_URI = "/";
  /**一日における、いいねの最大数 */
  private const MAX_LIKE_DAILY_LIMIT = 10;

  /**
   * DB接続を試みる
   * 
   * 本番DBのDSNファイル（/sakuraDSN）が存在する場合、そのDBへの接続を試みる
   * そうでない場合、テストDBへの接続を試みる
   * 
   * 成功した場合、PDO及びURIを自身のインスタンスに代入する
   * トップページのURIは、"/index.php"の場合は"/"とする
   *
   * @return void
   */
  function connect()
  {
    $charset = 'utf8mb4';
    $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $sakuraDSN = __DIR__ . '/../../../sakuraDSN.php';
    $testDSN = __DIR__ . '/../../../testDSN.php';
    $DBHost     = null;
    $DBName   = null;
    $DBUserName = null;
    $DBPassword = null;
    // さくらレンタルDBのDSN
    if (file_exists($sakuraDSN)) {
      $sakuraDB = require $sakuraDSN;
      $DBHost     = $sakuraDB['main_host'] ?? null;
      $DBName   = $sakuraDB['main_dbname'] ?? null;
      $DBUserName = $sakuraDB['main_username'] ?? null;
      $DBPassword = $sakuraDB['main_password'] ?? null;
    } else if (file_exists($testDSN)) {
      //テストDBのDSN
      $testDB = require $testDSN;
      $DBHost     = $testDB['main_host'] ?? null;
      $DBName   = $testDB['main_dbname'] ?? null;
      $DBUserName = $testDB['main_username'] ?? null;
      $DBPassword = $testDB['main_password'] ?? null;
    } else {
      return;
    }

    if ($DBHost !== null) {
      try {
        $main_DSN = "mysql:host=$DBHost;dbname=$DBName;charset=$charset";
        $this->pdo = new PDO($main_DSN, $DBUserName, $DBPassword, $options);
      } catch (\PDOException $e) {
        error_log("DB接続に失敗しました: " . $e->getMessage());
      }
    } else {
      return;
    }

    //URIを取得する
    //同一ページであるため、"index.php"である場合、"/"とする
    $uri = $_SERVER['REQUEST_URI'];
    if ($uri === "/index.php") {
      $uri = self::TOP_PAGE_URI;
    }
    $this->uri = $uri;
  }

  /**
   * 現在のページの、いいねの総数を返す
   * 
   * 総数が最大値を超える場合は、最大値とする　※通常は発生しない
   *
   * @return integer 現在のページの、いいねの総数
   */
  function getLikeCount(): int
  {
    if (!isset($this->pdo)) {
      echo "エラー：DB未接続";
      return 0;
    }

    $sql = "SELECT like_count FROM like_counts WHERE like_uri = :uri";
    $sth = $this->pdo->prepare($sql);
    try {
      $sth->execute([
        ':uri' =>  $this->uri
      ]);

      $likeCount = $sth->fetchColumn();
      $isNotLikePage = $likeCount === false;
      if ($isNotLikePage) {
        $likeCount = 0;
      } else {
        $likeCount = (int)$likeCount;
      }

      if ($likeCount > self::MAX_SUM_LIKE_COUNT) {
        $likeCount = self::MAX_SUM_LIKE_COUNT;
      }

      return $likeCount;
    } catch (Exception $e) {
      echo "エラー：execute";
    }
    return 0;
  }

  /**
   * いいねをしたユーザー情報と日時をDBに登録した後、
   * そのページにおけるいいね数を更新する
   * その後、エラーメッセージが無いことを示す空文字「""」を返す
   * 
   * 以下の場合は登録を行わず、場合に応じたエラーメッセージを返す
   * ・本日のいいね数の上限に達している場合
   * ・送られたURIが自身のページのURIと異なる場合
   * ・ページのいいねが最大値である場合
   * ・SQL文のtryに失敗した場合
   *
   * @return string エラーメッセージ 
   */
  function checkInsertLike(string $uri, string $ipAddress, string $likeUserCookie, string $todayDateYMD): string
  {

    if ($this->isLikeDailyLimit($ipAddress, $likeUserCookie, $todayDateYMD)) {
      return "たくさんいいねありがとう！";
    }
    if ($this->getLikeCount() >= self::MAX_SUM_LIKE_COUNT) {
      return "これ以上いいねできません";
    }

    $like_uri = $uri ?? null;
    if ($like_uri !== $this->uri) {
      return "エラー：URI";
    }

    try {
      $this->insertLikeLog($ipAddress, $likeUserCookie, $todayDateYMD);
    } catch (Exception $e) {
      return "エラー：いいねログの登録";
    }

    try {
      $this->incrementLikeCount();
    } catch (Exception $e) {
      return "エラー：いいね数の更新";
    }

    return "";
  }

  /**
   * いいね数を増加させる
   * 
   * ページのURIを保存し、そのいいね数（count）を1とするレコード生成を試みる
   * 既に該当のレコードが存在する場合、生成を行わずにcountを一つ増やす
   *
   * @return void
   */
  function incrementLikeCount()
  {
    $firstLikeCount = 1;
    $incrementValue = 1;
    $sql = "INSERT INTO like_counts (like_uri, like_count) 
            VALUES (:uri, :firstLikeCount) 
            ON DUPLICATE KEY UPDATE like_count = like_count + :incrementValue";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':uri', $this->uri, PDO::PARAM_STR);
    $stmt->bindValue(':firstLikeCount', $firstLikeCount, PDO::PARAM_INT);
    $stmt->bindValue(':incrementValue', $incrementValue, PDO::PARAM_INT);
    $stmt->execute();
  }


  /**

   * 誰がいつの日時にいいねしたかを記録し、いいね上限の判定に使う
   * 
   * ※DB側の設定により、古いデータ（2日前以前）を自動削除するようにすること
   *
   * @param string $ipAddress ipアドレス
   * @param string $likeUserCookie ユーザーのCookie
   * @param string $todayDateYMD 今日の日付
   * @return void
   */
  function insertLikeLog(string $ipAddress, string $likeUserCookie, string $todayDateYMD)
  {
    $sql = "INSERT INTO like_logs (like_uri, like_ip_address, like_date,like_user_cookie) VALUES (:uri, :ipAddress, :likeDate,:likeUserCookie)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':uri', $this->uri, PDO::PARAM_STR);
    $stmt->bindValue(':ipAddress', $ipAddress, PDO::PARAM_STR);
    $stmt->bindValue(':likeDate', $todayDateYMD, PDO::PARAM_STR);
    $stmt->bindValue(':likeUserCookie', $likeUserCookie, PDO::PARAM_STR);
    $stmt->execute();
  }

  /**
   * いいねの数が、一日にできる最大数に到達したか判定する
   * 
   * 以下のデータの数が、いいねの最大値以上である場合をtrueとする
   * ・日付及び、IPアドレスまたはcookieの値が送信者と同一のデータ
   *
   * @param string $ipAddress ipアドレス
   * @param string $likeUserCookie いいねした人のcookieの値
   * @param string $todayDateYMD 今日の日付 y-m-d
   * @return boolean 今日のいいね数が最大数 / 最大数ではない
   */
  function isLikeDailyLimit(string $ipAddress, string $likeUserCookie, string $todayDateYMD): bool
  {
    $sql = "SELECT COUNT(*) FROM like_logs WHERE `like_date` = :todayDate  AND (`like_ip_address` = :ipAddress OR `like_user_cookie` = :likeCookie)";
    $stmt = $this->pdo->prepare($sql);

    $stmt->bindValue(':todayDate', $todayDateYMD, PDO::PARAM_STR);
    $stmt->bindValue(':ipAddress', $ipAddress, PDO::PARAM_STR);
    $stmt->bindValue(':likeCookie', $likeUserCookie, PDO::PARAM_STR);
    try {
      $stmt->execute();
      $currentCount = (int)$stmt->fetchColumn();
      return $currentCount >= self::MAX_LIKE_DAILY_LIMIT;
    } catch (Exception $e) {
      error_log("エラー：isLikeDailyLimit - " . $e->getMessage());
      return false;
    }
  }
}
