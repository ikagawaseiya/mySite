<?php

/**
 * ページ名を受け取り、ヘッダーを表示する
 *
 * @param string $pageTitle ページのタイトル
 * @param array $cssPaths 追加するCSSファイルのパスの配列
 * @return void
 */
function showHeader(string $pageTitle = '', array $cssPaths = []): void
{
  $displayHeaderTitle = SITE_NAME . ":" . $pageTitle;
  $blogPosts =  FileGetter::getArrayNewestPageFirst(PathGetter::getBlogFilePath());
  $galleryPosts = FileGetter::getArrayNewestPageFirst(PathGetter::getGalleryFilePath());
  $gamePosts = FileGetter::getArrayNewestPageFirst(PathGetter::getGameFilePath());
  include_once __DIR__ . '/htmlStartPoint.php';
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

/**
 * headタグに必要な以下の要素を付与する
 * ・metaタグ
 * ・titleタグ
 * ・linkタグ
 *
 * @param string $pageTitle ページのタイトル
 * @param array $cssPaths ページごとに付与する、CSSの配列
 * @return void
 */
function renderHeadTagElements(string $pageTitle = '', array $cssPaths = []): void
{
  include_once __DIR__ . '/headTagStartPoint.php';
  echo PHP_EOL;
  $nestSpace = '  ';
  if ($pageTitle !== '') {
    $htmlTitle = Common::getTitleInHtml($pageTitle);
    echo $nestSpace . '<title>' . Common::h($htmlTitle) . '</title>' . PHP_EOL;
  }
  if (!empty($cssPaths)) {
    foreach ($cssPaths as $cssPath) {
      echo $nestSpace . '<link rel="stylesheet" href="' . Common::h($cssPath) . '">' . PHP_EOL;
    }
  }
  echo   "</head>" . PHP_EOL;
}
