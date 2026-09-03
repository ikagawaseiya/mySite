<?php
$title = "ギャラリー その１";
$date = '2026-08-16';
$displayFileName = "gallery_1";
$this->displayGalleryHead($title);
?>

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