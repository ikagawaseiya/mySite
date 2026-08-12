<?php

/**
 * トップページのコントローラー
 */
class topPageController
{
  /**
   * トップページに渡す値を宣言し、viewを呼び出す
   * 
   * 渡す値:ページ名
   */
  public function show()
  {
    $pageTitle = "トップページ";
    showHeader($pageTitle);
    $htmlTitle = Common::getHtmlPageTitle($pageTitle);
    $blogPosts = $this->getBlogAndGameArrayNewestPageFirst();
    $newestPageLoopLimit = min(5, count($blogPosts));
    require_once __DIR__ . '/../View/topPageView.php';
  }


  /**
   * 新着順に並べた、ブログとゲームの記事を生成する
   * それを返す
   *
   * @return array 新着順に並べた、ブログとゲームの記事
   */
  public function getBlogAndGameArrayNewestPageFirst(): array
  {
    $blogFilePass = __DIR__ . '/../View/blog';
    $blogFiles = Common::getPhpFilesFromDir($blogFilePass);
    $gameFilePass = __DIR__ . '/../View/game';
    $gameFiles = Common::getPhpFilesFromDir($gameFilePass);
    $targetFiles = array_merge($blogFiles, $gameFiles);
    return Common::createArrayNewestPageFirst($targetFiles);
  }

  /**
   * 最新記事リストのHTMLを表示する
   *
   * @param array $blogPosts 記事データの配列
   * @param int $limit 表示する最大件数
   * @return void
   */
  public static function renderNewestPostsList(array $blogPosts, int $limit = 5): void
  {
    $loopCount = min($limit, count($blogPosts));
    include __DIR__ . '/../View/postList.php';
  }
}
