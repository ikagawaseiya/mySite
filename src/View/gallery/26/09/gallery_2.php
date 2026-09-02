<?php
$title = "ギャラリー その2";
$date = '2026-09-02';
$displayTitle = Common::getTitleInHtml($title . $date);
$displayFileName = "gallery_2";
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo Common::h($displayTitle); ?></title>
  <link rel="stylesheet" href="/public/css/gallery.css">
  <script src="/public/js/header.js" defer></script>
</head>

<body>
  <div>
    <main class="main-content center-element">
      <div>
        <?php echo Common::h($date); ?>
      </div>
      <p>うーちゃんのギャラリーその２。<br>
        撮影時期は約5年前です。<br>
      </p>
      <div>
        <?php $this->showAllGalleryFromDir($displayFileName); ?>
      </div>
    </main>
    <?php showFooter(); ?>