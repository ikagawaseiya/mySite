<?php

/**
 * ブログ記事全ページのコントローラー
 * ヘッダーの表示の後、ページを表示する
 */
class BlogPageController
{
  /**
   * @param string $blogPageName 記事のファイル名（拡張子なし）
   */
  public function show(string $blogPageName)
  {
    if (preg_match('/\.\./', $blogPageName)) {
      $this->show404();
    }

    $viewFile = PathGetter::getBlogFilePathFromController() . '/' . $blogPageName . '.php';
    if (file_exists($viewFile)) {
      $this->showHeaderGetTitleFromThePage($viewFile);
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

  /**
   *ページからタイトルを取得し、
   *それによるヘッダーを表示する
   *
   * @param  mixed $viewFile
   * @return void
   */
  private function showHeaderGetTitleFromThePage(string $viewFile)
  {
    $content = file_get_contents($viewFile, false, null, 0, 1024);
    if (preg_match('/\$title\s*=\s*[\'"](.+?)[\'"]\s*;/', $content, $matches)) {
      $title = trim($matches[1]);
    } else {
      $title = ' '; // デフォルトの名前　※通常は取得しない
    }
    if (function_exists('showHeader')) {
      showHeader($title);
    }
  }

  /**
   * ブログのheadを表示する
   *
   * @param string $title ページのタイトル
   * @return void
   */
  public function displayBlogHead(string $title)
  {
    $displayTitle = Common::getTitleInHtml($title);
?>
    <!DOCTYPE html>
    <html lang="ja">

    <div class="footerFixed">

      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo Common::h($displayTitle); ?></title>
        <link rel="stylesheet" href="/public/css/blog.css">
        <script src="/public/js/header.js" defer></script>
      </head>

      <body>
    <?php
  }
}
