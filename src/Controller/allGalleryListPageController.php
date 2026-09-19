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
   * ・ブログ一覧を新着順にしたリスト
   */
  public function show()
  {
    $pageTitle = "ギャラリー一覧";
    $titleInHtml = Common::getTitleInHtml($pageTitle);
    echo '<title>' . Common::h($titleInHtml) . '</title>
    <link rel="stylesheet" href="/public/css/allTypeListPage.css">';
    showHeader($pageTitle);
    $galleryPosts = FileGetter::getArrayNewestPageFirst(PathGetter::getGalleryFilePath());
    require_once __DIR__ . '/../View/allGalleryList/allGalleryListPage.php';
  }
}
