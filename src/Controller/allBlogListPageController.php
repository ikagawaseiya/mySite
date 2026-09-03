<?php

/**
 * ブログリストページのコントローラー
 */
class AllBlogListPageController
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
    $titleInHtml = Common::getTitleInHtml($pageTitle);
    $blogPosts = FileGetter::getArrayNewestPageFirst(PathGetter::getBlogFilePath());
    require_once __DIR__ . '/../View/allBlogList/allBlogListPage.php';
  }
}
