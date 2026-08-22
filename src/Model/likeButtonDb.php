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
class LikeButtonDb
{
  /**PDOのインスタンス */
  private PDO $pdo;
  /**URIのインスタンス */
  private string $uri;
  /*いいね数の最大値*/
  private const MAX_LIKE_COUNT = 999999;
  /**トップページのURI */
  private const TOP_PAGE_URI = "/";

  /**
   * DB接続を試みる
   * 成功した場合、PDO及びURIを自身のインスタンスに代入する
   * トップページのURIは、"/index.php"の場合でも"/"とする
   *
   * @return void
   */
  function connect()
  {
    $host = 'localhost';
    $dbname = 'test_db';
    $username = 'user';
    $password = 'password';
    $charset = 'utf8mb4';


    //  DSN（データソースネーム）を設定
    $DNS = "mysql:host=$host;dbname=$dbname;charset=$charset";

    $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
      $pdo = new PDO($DNS, $username, $password, $options);
      $this->pdo  = $pdo;
    } catch (\PDOException $e) {
      echo "エラー：LikeButtonDb::connect";
    }

    //URIを取得する
    //同一ページであるため、"index.php"である場合、"/"とする
    $uri = $_SERVER['REQUEST_URI'];
    if ($uri === "/index.php") {
      $uri = self::TOP_PAGE_URI;
    }
    $this->uri = $uri;

    //TODO
    echo $this->uri . "URIテスト表示";
  }

  /**
   * PHPDataObjectを返す
   * 
   * TODO いらないかも
   *
   * @return PDO testDBのPDO
   */
  function getPDO()
  {
    return $this->pdo;
  }

  /**
   * 現在のページの、いいねの総数を返す
   * 最大値を超える場合は、最大値とする
   *
   * @return integer
   */
  function getLikeCount(): int
  {
    $sql = "SELECT * FROM like_button WHERE like_uri = :uri";
    $sth = $this->pdo->prepare($sql);
    $sth->execute([
      ':uri' =>  $this->uri
    ]);
    $likeCount = $sth->rowCount();
    if ($likeCount > self::MAX_LIKE_COUNT) {
      $likeCount = self::MAX_LIKE_COUNT;
    }
    return $likeCount;
  }

  /**
   * 現在のページの、いいねをDBに登録する
   * 
   * 送られたURIが自身のページのURIと異なる場合、登録しない
   * 
   * TODO 後で直す　不要かも？
   *
   * @return bool 登録成否
   */
  function insertLike(string $uri)
  {
    $like_uri = $uri ?? null;
    if ($like_uri !== $this->uri) {
      return;
    }
    $sql = "INSERT INTO like_button (like_uri) VALUES (:uri)";
    $sth = $this->pdo->prepare($sql);

    try {
      $sth->execute([
        ':uri' => $this->uri
      ]);
    } catch (Exception $e) {
      echo "エラー：registerLike";
    }
  }
}
