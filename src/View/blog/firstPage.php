<?php

/**
 * @title 初めてのブログ記事
 * @date 2026-08-11 12:00:00
 */
$fileContent = file_get_contents(__FILE__, false, null, 0, 512);
$pageTitle = 'ブログ'; // 初期値
if (preg_match('/@title\s+(.+)/', $fileContent, $matches)) {
  $pageTitle = trim($matches[1]);
}
?>
<!-- View/profile_view.php の内容をベースにしたブログデザイン -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo Common::h($pageTitle); ?></title>
  <link rel="stylesheet" href="/public/css/style.css">
  <link rel="stylesheet" href="/public/css/header.css">
  <script src="/public/js/header.js" defer></script>
</head>

<body>
  <div>
    <main class="main-content">
      <h1><?php echo Common::h($pageTitle); ?></h1>
      <p>就活と自主学習のため、新たにホームページを作成しました。<br>
        今後、必要に応じてページを増やす予定です。</p>
    </main>
    <footer>
    </footer>
  </div>
</body>

</html>