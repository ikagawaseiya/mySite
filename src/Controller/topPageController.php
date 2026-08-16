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
    $titleInHtml = Common::getTitleInHtml($pageTitle);
    $newestPosts = $this->getContentsArrayNewestPageFirst();
    $newestPageLoopLimit = min(5, count($newestPosts));
    require_once __DIR__ . '/../View/topPage/topPageView.php';
  }

  /**
   * 以下の種類のページのタイトル、日時、URLを格納した配列を生成する
   * ・ブログ
   * ・ゲーム
   * ・ギャラリー
   * 
   * 
   * その後、新着順に並べ変える
   * それを返す
   * 
   * 新着記事の表示のために使う
   *
   * @return array 新着順に並べた、ブログとゲームの記事
   */
  public function getContentsArrayNewestPageFirst(): array
  {
    $blogFiles = FileGetter::getPhpFilesFromDir(PathGetter::getBlogFilePathFromController());
    $galleryFiles = FileGetter::getPhpFilesFromDir(PathGetter::getGalleryFilePathFromController());

    //ゲーム記事は現在未実装
    $gameFilePath = __DIR__ . '/../View/game';
    //$gameFiles;
    $gameFiles = FileGetter::getPhpFilesFromDir($gameFilePath);

    $targetFiles = array_merge($blogFiles, $gameFiles, $galleryFiles);
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
    include __DIR__ . '/../View/topPage/newestPostDisplayer.php';
  }
}
