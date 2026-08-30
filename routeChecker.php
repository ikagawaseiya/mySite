<?php

/**
 * ルート確認クラス
 * 
 * ページの種別を表す文字列$pageを受け取り、それに対応するページを呼び出す
 */
class RouteChecker
{
  function routeCheck(string $page)
  {
    $this->checkIsTopPage($page);
    $this->checkIsGameDirectory($page);
    $this->checkIsBlogDirectory($page);
    $this->checkIsGalleryDirectory($page);
    $this->checkIsAllBlogListPage($page);
    $this->checkIsAllGalleryListPage($page);
  }

  /**
   * ゲームのページであるか確認する。
   * その場合、gamePageControllerを呼び出す
   * 
   * @param string $page 現在のページ名
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
   * @param string $page 現在のページ名
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
   * @param string $page 現在のページ名
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
   * ブログ一覧ページであるか確認する。
   * その場合、blogListPagePageControllerを呼び出す
   * 
   * @param string $page 現在のページ名
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
   * その場合、blogListPagePageControllerを呼び出す
   * 
   * @param string $page 現在のページ名
   */
  function checkIsAllGalleryListPage(string $page)
  {
    if (strpos($page, "galleryList") !== false) {
      require_once __DIR__ . '/src/Controller/allGalleryListPageController.php';
      $controller = new AllBlogListPageController();
      $controller->show();
      exit;
    }
  }

  /**
   * トップページであるか確認する。
   * その場合、topPageControllerを呼び出す
   * 
   * @param string $page 現在のページ名
   */
  function checkIsTopPage(string $page)
  {
    if ($page === '' || $page === 'index.php') {
      require_once __DIR__ . '/src/Controller/topPageController.php';
      $controller = new topPageController();
      $controller->show();
      exit;
    }
  }
}
