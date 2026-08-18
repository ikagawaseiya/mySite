<?php
$title = 'ブログ一覧のページを作成しました';
$date = '2026-08-14';
$this->displayBlogHead($title);
?>
<div>
  <main class="main-content">
    <div>
      <?php echo Common::h($date); ?>
    </div>
    <h1><?php echo Common::h($title); ?></h1>
    <p>ブログ一覧のページを作成しました。<br>
      今後ページが増えた場合、ヘッダーのメニューには収まりきらなくなる可能性があるためです。<br>
    <div>
      もっと記したい事はあるのですが、週末間際の勤務後なので疲れてしまいました。<br>
      凝った機能の実装や、有意義なブログページも増やしていきたいですが、しばらくは機能の最適化や拡張で時間がかかりそうです。</div>
    </p>
  </main>
  <?php showFooter(); ?>