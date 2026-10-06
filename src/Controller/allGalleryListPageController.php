<?php

/**
 * ギャラリー一覧ページのコントローラー
 */
class AllGalleryListPageController
{
  /**
   * ギャラリー 一覧ページに渡す値を宣言し、viewを呼び出す
   * 
   * 渡す値:
   * ・ページタイトル
   * ・ブログ一覧を新着順にしたリスト
   * ・ページに用いるCSS
   */
  public function show()
  {
    $pageTitle = "ギャラリー一覧";
    $posts = FileGetter::getArrayNewestPageFirst(PathGetter::getGalleryFilePath());
    $cssPaths = ["/public/css/allTypeListPage.css"];
    require_once __DIR__ . '/../View/allListPageForTypes/allListPage.php';
  }
}
