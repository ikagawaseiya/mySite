<?php

/**
 * 
 * いいねボタンのDBを扱うクラス
 * 
 * DBの内部構造は以下とすること
 * テーブル名：like_button
 * カラム名:like_uri TEXT型
 * 
 */
class LikeButtonDB
{
  /**PDOのインスタンス */
  private PDO $pdo;
  /*いいね数の最大値*/
  private const MAX_LIKE_COUNT = 999999;
  /**トップページのURI */
  private const TOP_PAGE_URI = "/";
  /**URIのインスタンス */
  public string $uri;

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
    $main_host     = null;
    $main_dbname   = null;
    $main_username = null;
    $main_password = null;
    // さくらレンタルDBのDSN
    if (file_exists($sakuraDSN)) {
      $sakuraDB = require $sakuraDSN;
      $main_host     = $sakuraDB['main_host'] ?? null;
      $main_dbname   = $sakuraDB['main_dbname'] ?? null;
      $main_username = $sakuraDB['main_username'] ?? null;
      $main_password = $sakuraDB['main_password'] ?? null;
    }

    //テスト用DBのDSN
    $test_host = 'localhost';
    $test_dbname = 'test_db';
    $test_username = 'user';
    $test_password = 'password';

    if ($main_host !== null) {
      try {
        $main_DSN = "mysql:host=$main_host;dbname=$main_dbname;charset=$charset";
        $this->pdo = new PDO($main_DSN, $main_username, $main_password, $options);
        $mainDBConnected = true;
      } catch (\PDOException $e) {
        error_log("本命DBの接続失敗、テストDBへ切り替えます: " . $e->getMessage());
        $mainDBConnected = false;
      }
    } else {
      // ファイルがない場合は最初から本命への接続をスキップする
      $mainDBConnected = false;
    }

    // テストDB接続
    if (!$mainDBConnected) {
      try {
        $test_DSN = "mysql:host=$test_host;dbname=$test_dbname;charset=$charset";
        $this->pdo = new PDO($test_DSN, $test_username, $test_password, $options);
      } catch (\PDOException $test_e) {
        error_log("すべてのDB接続に失敗しました: " . $test_e->getMessage());
        echo "エラー：LikeButtonDB:connect";
      }
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
   * 最大値を超える場合は、最大値とする
   *
   * @return integer
   */
  function getLikeCount(): int
  {
    if (!isset($this->pdo)) {
      echo "エラー：DB未接続";
      return 0;
    }

    $sql = "SELECT * FROM like_button WHERE like_uri = :uri";
    $sth = $this->pdo->prepare($sql);
    try {
      $sth->execute([
        ':uri' =>  $this->uri
      ]);
      $likeCount = $sth->rowCount();
      if ($likeCount > self::MAX_LIKE_COUNT) {
        $likeCount = self::MAX_LIKE_COUNT;
      }
      return $likeCount;
    } catch (Exception $e) {
      echo "エラー：execute";
    }
    return 0;
  }

  /**
   * 現在のページの、いいねをDBに登録する
   * 
   * ・以下の場合は登録を行わない
   * 送られたURIが自身のページのURIと異なる場合
   * ページのいいねが最大値である場合
   *
   * @return bool 登録成否
   */
  function insertLike(string $uri)
  {
    $like_uri = $uri ?? null;
    if ($like_uri !== $this->uri || $this->getLikeCount() >= self::MAX_LIKE_COUNT) {
      return;
    }
    $sql = "INSERT INTO like_button (like_uri) VALUES (:uri)";
    $sth = $this->pdo->prepare($sql);

    try {
      $sth->execute([
        ':uri' => $this->uri
      ]);
    } catch (Exception $e) {
      throw $e;
    }
  }
}
