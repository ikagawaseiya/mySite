<?php

/**
 * 
 * TODO　将来的に利用する
 * 
 */
class TestDBConnector
{
  private $pdoInstance;

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
      echo "DB接続に成功しました";
      $pdo = new PDO($dataSourceName, $username, $password, $options);
      $this->pdoInstance = $pdo;
    } catch (\PDOException $e) {
      echo "エラー：DB接続失敗 testDBConnector";
    }
  }
}
