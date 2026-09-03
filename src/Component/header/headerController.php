<?php

/**
 * ページ名を受け取り、ヘッダーを表示する
 *
 * @param string $pageName
 * @return void
 */
function showHeader(string $pageName = ''): void
{
  $displayHeaderTitle = SITE_NAME . ":" . $pageName;
  $blogPosts =  FileGetter::getArrayNewestPageFirst(PathGetter::getBlogFilePath());
  $galleryPosts = FileGetter::getArrayNewestPageFirst(PathGetter::getGalleryFilePath());
  $gamePosts = FileGetter::getArrayNewestPageFirst(PathGetter::getGameFilePath());
  require_once __DIR__ . '/headerView.php';
}

/**
 * ギャラリーのドロップダウンリンク内のHTMLを生成する
 * 
 * @param array $targetPosts 投稿データの配列
 * @return string 生成されたHTML文字列
 */
function displayDropdownLinksHtml(array $targetPosts): string
{
  if (!defined("MAX_PAGE_COUNT_IN_DROPDOWN")) {
    define("MAX_PAGE_COUNT_IN_DROPDOWN", 5);
  }
  $maxCount = min(MAX_PAGE_COUNT_IN_DROPDOWN, count($targetPosts));
  $html = '';

  for ($i = 0; $i < $maxCount; $i++) {
    $post = $targetPosts[$i];
    $url = Common::h($post['url']);
    $title = Common::h($post['title']);

    $html .= '<a href="' . $url . '">' . $title . '</a>' . PHP_EOL;
  }

  return $html;
}
