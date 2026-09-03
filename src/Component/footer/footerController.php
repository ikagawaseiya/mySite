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
  $thereAreBeforeAndAfterPosts = getThereAreBeforeAndAfterPosts($thisPagePath);
  if ($thereAreBeforeAndAfterPosts) {
    foreach ($thereAreBeforeAndAfterPosts as $index => $blogpost) {

      if ($blogpost["url"]  === $thisUri) {
        $isLatestPage = $index > 0;
        if ($isLatestPage) {
          $nextPost = $thereAreBeforeAndAfterPosts[$index - 1];
          if ($nextPost["url"] !== '') {
            $nextPageButton = '<a href=' . Common::h($nextPost["url"]) . '>' . $nextPageButtonMessage . '</a>';
          }
        }

        $isOldestPage = $index < count($thereAreBeforeAndAfterPosts) - 1;
        if ($isOldestPage) {
          $PreviousPost = $thereAreBeforeAndAfterPosts[$index + 1];
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

/**
 * 現在のページが前の記事へ、次の記事へのボタンを実装するページである場合、
 * 同種の記事を新着順に格納した配列を作成する
 * それを返す
 * 
 * 以下の種類ページを対象とする
 * ・ブログ
 * ・ギャラリー
 *
 * @param string $thisPagePath 現在のページのパス
 * @return array 前の記事へ、次の記事へのボタンを実装する記事を、新着順とした配列
 */
function getThereAreBeforeAndAfterPosts(string $thisPagePath): array
{
  $thereAreBeforeAndAfterPosts = [];
  if (strpos($thisPagePath, 'blog/') === 0) {
    $thereAreBeforeAndAfterPosts =  FileGetter::getArrayNewestPageFirst(PathGetter::getBlogFilePath());
  } else if (strpos($thisPagePath, 'gallery/') === 0) {
    $thereAreBeforeAndAfterPosts =  FileGetter::getArrayNewestPageFirst(PathGetter::getGalleryFilePath());
  }
  return  $thereAreBeforeAndAfterPosts;
}
