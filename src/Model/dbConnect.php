<?php

/**
 * 
 * TODO　将来的に利用する
 * 
 */
// 1. データベースの接続情報を変数にまとめる
$host = 'localhost';      // サーバー名（ローカル環境ならlocalhost）
$dbname = 'your_db_name'; // データベース名
$username = 'your_user';  // ユーザー名
$password = 'your_pass';  // パスワード
$charset = 'utf8mb4';     // 文字コード

// 2. DSN（データソースネーム）を設定
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// 3. 安全な接続オプションを設定
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // エラー時に例外を投げる
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // データを連想配列で取得
  PDO::ATTR_EMULATE_PREPARES   => false,                  // SQLインジェクション対策
];

try {
  // 4. PDOインスタンスを作成して接続
  $pdo = new PDO($dsn, $username, $password, $options);
  // 接続成功時の処理（テスト用、本番は不要）
  // echo "接続成功！"; 
} catch (\PDOException $e) {
  // 5. 接続エラー時の例外処理
  throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
