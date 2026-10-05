<?php

/**
 * ルート確認クラス
 * 
 * ページの種別を表す文字列$pageを受け取り、それに対応するページを呼び出す
 */
class RouteChecker
{
  /**
   * 受け取ったページパスのルートを確認する
   *
   * @param string $page ページのパス
   * @return void
   */
  function routeCheck(string $page)
  {
    $this->checkIsTopPage($page);
    $this->checkIsGameDirectory($page);
    $this->checkIsBlogDirectory($page);
    $this->checkIsGalleryDirectory($page);
    $this->checkIsAllGameListPage($page);
    $this->checkIsAllBlogListPage($page);
    $this->checkIsAllGalleryListPage($page);
    $this->checkIsSiteExplanationDirectory($page);
  }

  /**
   * このサイトについてのページであるか確認する。
   * その場合、siteExplanationControllerを呼び出す
   *
   * @param string $page 現在のページのパス
   * @return void
   */
  function checkIsSiteExplanationDirectory(string $page)
  {
    if (strpos($page, "siteExplanation") !== false) {
      require_once __DIR__ . '/src/Controller/siteExplanationController.php';
      $controller = new SiteExplanationController();
      $controller->show();
      exit;
    }
  }

  /**
   * ゲームのページであるか確認する。
   * その場合、gamePageControllerを呼び出す
   * 
   * @param string $page 現在のページのパス
   */
  function checkIsGameDirectory(string $page)
  {
    if (strpos($page, 'game/') === 0) {
      require_once __DIR__ . '/src/Controller/gamePageController.php';
      $controller = new GamePageController();
      $articleName = substr($page, 5);
      $controller->show($articleName);
      exit;
    }
  }

  /**
   * ブログのページであるか確認する。
   * その場合、BlogPageControllerを呼び出す
   * 
   * @param string $page 現在のページのパス
   */
  function checkIsBlogDirectory(string $page)
  {
    if (strpos($page, 'blog/') === 0) {
      require_once __DIR__ . '/src/Controller/blogPageController.php';
      $controller = new BlogPageController();
      $articleName = substr($page, 5);
      $controller->show($articleName);
      exit;
    }
  }

  /**
   * ギャラリーのページであるか確認する。
   * その場合、GalleryPageControllerを呼び出す
   * 
   * @param string $page 現在のページのパス
   */
  function checkIsGalleryDirectory(string $page)
  {
    if (strpos($page, 'gallery/') === 0) {
      require_once __DIR__ . '/src/Controller/galleryPageController.php';
      $controller = new GalleryPageController();
      $articleName = substr($page, 8);
      $controller->show($articleName);
      exit;
    }
  }

  /**
   * ゲーム一覧ページであるか確認する。
   * その場合、allGameListPageControllerを呼び出す
   * 
   * @param string $page 現在のページのパス
   */
  function checkIsAllGameListPage(string $page)
  {
    if (strpos($page, "gameList") !== false) {
      require_once __DIR__ . '/src/Controller/allGameListPageController.php';
      $controller = new AllGameListPageController();
      $controller->show();
      exit;
    }
  }

  /**
   * ブログ一覧ページであるか確認する。
   * その場合、allBlogListPageControllerを呼び出す
   * 
   * @param string $page 現在のページのパス
   */
  function checkIsAllBlogListPage(string $page)
  {
    if (strpos($page, "blogList") !== false) {
      require_once __DIR__ . '/src/Controller/allBlogListPageController.php';
      $controller = new AllBlogListPageController();
      $controller->show();
      exit;
    }
  }

  /**
   * ギャラリー一覧ページであるか確認する。
   * その場合、allBlogListPageControllerを呼び出す
   * 
   * @param string $page 現在のページのパス
   */
  function checkIsAllGalleryListPage(string $page)
  {
    if (strpos($page, "galleryList") !== false) {
      require_once __DIR__ . '/src/Controller/allGalleryListPageController.php';
      $controller = new AllGalleryListPageController();
      $controller->show();
      exit;
    }
  }

  /**
   * トップページであるか確認する。
   * その場合、topPageControllerを呼び出す
   * 
   * @param string $page 現在のページのパス
   */
  function checkIsTopPage(string $page)
  {
    if ($page === '' || $page === 'index.php') {
      require_once __DIR__ . '/src/Controller/topPageController.php';
      $controller = new TopPageController();
      $controller->show();
      exit;
    }
  }
}
