<?php

/**
 * ブログ記事を動的に管理・表示するコントローラー
 */
class blogController
{
  /**
   * @param string $articleName 記事のファイル名（拡張子なし）
   */
  public function show(string $articleName)
  {
    // 安全対策: 不正なパス（../../など）が含まれている場合は404
    if (preg_match('/\.\./', $articleName)) {
      $this->show404();
    }

    // 表示させたいブログファイルの絶対パス
    $viewFile = __DIR__ . '/../View/blog/' . $articleName . '.php';

    if (file_exists($viewFile)) {
      $content = file_get_contents($viewFile, false, null, 0, 1024);
      preg_match('/@title\s+(.+)/', $content, $pageTitle);
      // 共通ヘッダーを表示（必要に応じて）
      if (function_exists('showHeader')) {
        showHeader($pageTitle[1] ?? 'ブログ');
      }
      require_once $viewFile;
      exit;
    } else {
      Common::show404();
    }
  }

  private function show404()
  {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>指定されたブログ記事が見つかりません。";
    exit;
  }
}
