<?php
$title = 'ホームページを開設しました';
$date = '2026-08-11';
$this->displayBlogHead($title);
?>
<main class="main-content">
  <div>
    <?php echo Common::h($date); ?>
  </div>
  <h1><?php echo Common::h($title); ?></h1>
  <p>就活と自主学習のため、新たにホームページを作成しました。<br>
    今後、開発を進めてページを増やす予定です。</p>
</main>
<?php showFooter(); ?>