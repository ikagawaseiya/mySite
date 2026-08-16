<?php

/**
 * ブログ記事全ページのコントローラー
 * ヘッダーの表示の後、ページを表示する
 */
class BlogController
{
  /**
   * @param string $articleName 記事のファイル名（拡張子なし）
   */
  public function show(string $articleName)
  {
    if (preg_match('/\.\./', $articleName)) {
      $this->show404();
    }

    $viewFile = BlogPathGetter::getBlogFilePathFromController() . '/' . $articleName . '.php';

    if (file_exists($viewFile)) {
      $content = file_get_contents($viewFile, false, null, 0, 1024);
      if (preg_match('/\$title\s*=\s*[\'"](.+?)[\'"]\s*;/', $content, $matches)) {
        $title = trim($matches[1]);
      } else {
        $title = 'ブログ'; // デフォルトの名前　※通常は取得しない
      }

      // ヘッダーを表示
      if (function_exists('showHeader')) {
        showHeader($title);
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
