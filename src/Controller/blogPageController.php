<?php

/**
 * ブログ記事全ページのコントローラー
 * ファイル名を受け取り、そのページを表示する
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

    $viewFile = PathGetter::getBlogFilePath() . '/' . $blogPageName . '.php';
    if (file_exists($viewFile)) {
      require_once $viewFile;
      exit;
    } else {
      $this->show404();
    }
  }

  private function show404()
  {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>指定されたブログ記事が見つかりません。";
    exit;
  }

  /**
   * ブログのhead内の記述を表示する
   * その後、headerを表示する
   *
   * @param string $title ページのタイトル
   * @return void
   */
  public function displayBlogHead(string $title)
  {
    $displayTitle = Common::getTitleInHtml($title);
?>

    <title><?php echo Common::h($displayTitle); ?></title>
    <link rel="stylesheet" href="/public/css/blog.css">
<?php
    renderPageStartAndShowHeader($title);
  }
}
