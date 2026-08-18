<?php

/**
 * フッターを表示する
 * ページによって、ホームへ戻る、前の記事へ、次の記事へのボタンをそれぞれ表示するか判定する
 * 
 * フッターには、</body></html>が含まれる
 *
 * @return void
 */
function showFooter()
{
  $thisUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $thisPagePath = trim($thisUri, '/');

  $homeButton = "<span>　</span>";
  if ($thisPagePath  !== '' && $thisPagePath !== "index.php") {
    $homeButton = '<a href="/">ホームへ戻る</a>';
  }

  $PreviousPageButton = "<span>　</span>";
  $nextPageButton = "<span>　</span>";
  if (strpos($thisPagePath, 'blog/') === 0 || strpos($thisPagePath, 'gallery/') === 0) {

    $blogPosts =  FileGetter::getArrayNewestPageFirst(PathGetter::getBlogFilePathFromController());
    foreach ($blogPosts as $index => $blogpost) {

      if ($blogpost["url"]  === $thisUri) {

        $isLatestPage = $index > 0;
        if ($isLatestPage) {
          $nextPost = $blogPosts[$index - 1];
          if ($nextPost["url"] !== '') {
            $nextPageButton = '<a href="' . Common::h($nextPost["url"]) . '">次の記事へ</a>';
          }
        }

        $isOldestPage = $index < count($blogPosts) - 1;
        if ($isOldestPage) {
          $PreviousPost = $blogPosts[$index + 1];
          if ($PreviousPost["url"] !== '') {
            $PreviousPageButton = '<a href="' . Common::h($PreviousPost["url"]) . '">前の記事へ</a>';
          }
        }
        break;
      }
    }
  }

  require_once __DIR__ . '/footer.php';
}
