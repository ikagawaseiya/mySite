<?php
$title = "ギャラリー その2";
$date = '2026-09-02';
$displayFileName = "gallery_2";
$this->displayGalleryHead($title);
?>

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
</div>
<?php showFooter(); ?>