<?php

/**
 * ゲーム一覧ページのコントローラー
 */
class AllGameListPageController
{
  /**
   * ゲーム一覧ページに渡す値を宣言し、viewを呼び出す
   * 
   * 渡す値:
   * ・ページタイトル
   * ・ゲーム一覧を新着順にしたリスト
   * ・ページに用いるCSS
   */
  public function show()
  {
    $pageTitle = "ゲーム一覧";
    $posts = FileGetter::getArrayNewestPageFirst(PathGetter::getGameFilePath());
    $cssPaths = ["/public/css/allTypeListPage.css"];
    require_once __DIR__ . '/../View/allListPageForTypes/allListPage.php';
  }
}
