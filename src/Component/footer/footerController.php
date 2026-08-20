<?php

/**
 * フッターを表示する
 * ページによって、ホームへ戻る、前の記事へ、次の記事へのボタンをそれぞれ表示する
 * 
 * フッターには、</body></html>が含まれる
 *
 * @return void
 */
function showFooter()
{
  $thisUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $thisPagePath = trim($thisUri, '/');

  $hiddenClass = "class = 'is-button-hidden'";

  $homeButtonMessage = "ホームへ戻る";
  $homeButton = "<span" . " " . $hiddenClass . ">" . $homeButtonMessage . "</span>";
  $isNotTopPage = $thisPagePath  !== '' && $thisPagePath !== "index.php";
  if ($isNotTopPage) {
    $homeButton =  '<a href = "/">' . $homeButtonMessage . '</a>';
  }


  $PreviousPageButtonMessage = "前の記事へ";
  $nextPageButtonMessage = "次の記事へ";
  $PreviousPageButton = "<span" . " " . $hiddenClass . ">" . $PreviousPageButtonMessage . "</span>";
  $nextPageButton = "<span" . " " . $hiddenClass . ">" . $nextPageButtonMessage . "</span>";
  if (strpos($thisPagePath, 'blog/') === 0 || strpos($thisPagePath, 'gallery/') === 0) {

    $blogPosts =  FileGetter::getArrayNewestPageFirst(PathGetter::getBlogFilePathFromController());
    foreach ($blogPosts as $index => $blogpost) {

      if ($blogpost["url"]  === $thisUri) {

        $isLatestPage = $index > 0;
        if ($isLatestPage) {
          $nextPost = $blogPosts[$index - 1];
          if ($nextPost["url"] !== '') {
            $nextPageButton = '<a href=' . Common::h($nextPost["url"]) . '>' . $nextPageButtonMessage . '</a>';
          }
        }

        $isOldestPage = $index < count($blogPosts) - 1;
        if ($isOldestPage) {
          $PreviousPost = $blogPosts[$index + 1];
          if ($PreviousPost["url"] !== '') {
            $PreviousPageButton = '<a href=' . Common::h($PreviousPost["url"]) . '>' . $PreviousPageButtonMessage . '</a>';
          }
        }
        break;
      }
    }
  }
  require_once __DIR__ . '/footerView.php';
}
