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
   * ・ページタイトル
   * ・ブログ一覧を新着順にしたリスト
   * ・ページに用いるCSS
   */
  public function show()
  {
    $pageTitle = "ブログ一覧";
    $posts = FileGetter::getArrayNewestPageFirst(PathGetter::getBlogFilePath());
    $cssPaths = ["/public/css/allTypeListPage.css"];
    require_once __DIR__ . '/../View/allListPageForTypes/allListPage.php';
  }
}
