<?php

/**
 * ブログリストページのコントローラー
 */
class blogListPageController
{
  /**
   * ブログリストページに渡す値を宣言し、viewを呼び出す
   * 
   * 渡す値:
   * ・ブログ一覧を新着順にしたリスト
   */
  public function show()
  {
    $pageTitle = "ブログ一覧";
    showHeader($pageTitle);
    $htmlTitle = Common::getHtmlPageTitle($pageTitle);
    $blogPosts = Common::getArrayNewestPageFirst(Common::getBlogFilePathFromController());
    require_once __DIR__ . '/../View/blogListPage.php';
  }
}
