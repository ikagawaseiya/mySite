<?php

/**
 * 
 * いいねボタンのDBを扱うクラス
 * 
 * DBの内部構造は以下とすること
 * テーブル名：like_button
 * カラム名:like_uri
 * 
 */
class LikeButtonDb
{
  private PDO $pdo;
  private string $uri;
  /*いいねの表示最大値*/
  private const MAX_LIKE_COUNT = 999999;

  /**
   * DB接続を試みる
   * 成功した場合、PDO及びURIを自身のインスタンスに代入する
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
    $dataSourceName = "mysql:host=$host;dbname=$dbname;charset=$charset";

    $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
      $pdo = new PDO($dataSourceName, $username, $password, $options);

      //TODO
      echo "DB接続に成功しました/LikeButtonDbテスト表示";

      $this->pdo  = $pdo;
    } catch (\PDOException $e) {
      echo "エラー：LikeButtonDb::connect";
    }

    //URIを取得する
    //同一ページであるため、"index.php"である場合、"/"とする
    $uri = $_SERVER['REQUEST_URI'];
    if ($uri === "index.php") {
      $uri = "/";
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
   *
   * @return integer
   */
  function getLikeCount(): int
  {
    $sql = "SELECT * FROM like_button WHERE like_uri = :uri";
    $sth = $this->pdo->prepare($sql);
    $sth->execute([
      ':uri' => $this->uri
    ]);
    $likeCount = $sth->rowCount();
    if ($likeCount > self::MAX_LIKE_COUNT) {
      $likeCount = self::MAX_LIKE_COUNT;
    }
    return $likeCount;
  }
}
