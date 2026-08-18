<?php
function showFooter()
{
  $thisUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $thisPagePath = trim($thisUri, '/');

  $homeButton = "<span>　</span>";
  if ($thisPagePath  !== '') {
    $homeButton = '<a href=" / ">ホームへ戻る</a>';
  }

  $afterPageButton = "<span>　</span>";
  $nextPageButton = "<span>　</span>";
  if (strpos($thisPagePath, 'blog/') === 0) {
    //TODO
  }

  require_once __DIR__ . '/footer.php';
}
