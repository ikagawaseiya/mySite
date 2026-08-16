<?php
$title = 'ホームページを開設しました';
$date = '2026-08-11';
$displayTitle = Common::getTitleInHtml($title);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo Common::h($displayTitle); ?></title>
  <link rel="stylesheet" href="/public/css/blog.css">
  <script src="/public/js/header.js" defer></script>
</head>

<body>
  <div>
    <main class="main-content">
      <div>
        <?php echo Common::h($date); ?>
      </div>
      <h1><?php echo Common::h($title); ?></h1>
      <p>就活と自主学習のため、新たにホームページを作成しました。<br>
        今後、開発を進めてページを増やす予定です。</p>
    </main>
    <footer>
    </footer>
  </div>
</body>

</html>