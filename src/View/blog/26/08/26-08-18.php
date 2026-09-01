<?php
$title = 'フッターを作成中';
$date = '2026-08-18';
$this->displayBlogHead($title);
?>
<main class="main-content">
  <div>
    <?php echo Common::h($date); ?>
  </div>
  <h1><?php echo Common::h($title); ?></h1>
  <p>フッターを設置しました。
    現在はまだホームへ戻るボタンのみ実装しています。これだけでもなかなか便利。
    本日は疲れてしまっているので、続きは明日以降…。<br>
    ブログとギャラリーページには作成日時を設定してあるので、それを基準とした「前の記事」「次の記事」ボタンの実装を予定しています。
  </p>
</main>
<?php showFooter(); ?>