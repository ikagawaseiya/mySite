<?php
$title = "ギャラリー その３";
$date = '2026-09-20';
$displayFileName = "gallery_3";
$this->displayGalleryHead($title);
?>

<div>
  <main class="main-content center-element">
    <div>
      <?php echo Common::h($date); ?>
    </div>
    <p>うーちゃんのギャラリーその３。<br>
      前回に続いて、撮影時期は約4年前です。<br>
    </p>
    <div>
      <?php $this->showAllGalleryFromDir($displayFileName); ?>
    </div>
  </main>
</div>
<?php showFooter(); ?>