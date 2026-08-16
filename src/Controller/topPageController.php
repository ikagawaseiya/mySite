<?php

/**
 * トップページのコントローラー
 */
class topPageController
{
  /**
   * トップページに渡す値を宣言し、viewを呼び出す
   * 
   * 渡す値:
   * ・ページ名
   * ・hemlの表示名
   * ・新着記事に並び替えた記事リスト
   * ・表示する新着記事の表示数
   */
  public function show()
  {
    $pageTitle = "トップページ";
    showHeader($pageTitle);
    $htmlTitle = Common::getHtmlPageTitle($pageTitle);
    $newestPosts = $this->getBlogAndGameArrayNewestPageFirst();
    $newestPageLoopLimit = min(5, count($newestPosts));
    require_once __DIR__ . '/../View/topPageView.php';
  }


  /**
   * 新着順に並べた、ブログとゲームの記事を生成する
   * それを返す
   * 新着記事の表示のために使う
   *
   * @return array 新着順に並べた、ブログとゲームの記事
   */
  public function getBlogAndGameArrayNewestPageFirst(): array
  {
    $blogFiles = FileGetter::getPhpFilesFromDir(BlogPathGetter::getBlogFilePathFromController());


    //ゲーム記事は現在未実装
    $gameFilePath = __DIR__ . '/../View/game';
    //$gameFiles;
    $gameFiles = FileGetter::getPhpFilesFromDir($gameFilePath);

    $targetFiles = array_merge($blogFiles, $gameFiles);
    return FileGetter::createArrayNewestPageFirst($targetFiles);
  }

  /**
   * 最新記事リストのHTMLを表示する
   *
   * @param array $newestPosts 記事データの配列
   * @param int $limit 表示する最大件数
   * @return void
   */
  public static function showNewestPostsList(array $newestPosts, int $limit = 5): void
  {
    define("NEWEST_PAGE_LOOP_COUNT", min($limit, count($newestPosts)));
    include __DIR__ . '/../View/newestPostDisplayer.php';
  }
}
