<?php
$title = "ギャラリー その１";
$date = '2026-08-16';
$displayTitle = Common::getTitleInHtml($title . $date);
$displayFileName = "gallery_1";
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
      <p>我が家のうさぎ、うーちゃんのギャラリー。<br>
        撮影時期は6~7年前。<br>
        古いスマホで撮影したので、画質が荒いです。</p>
      <div>
        <?php $this->showAllGalleryFromDir($displayFileName); ?>
      </div>
    </main>
    <?php showFooter(); ?>