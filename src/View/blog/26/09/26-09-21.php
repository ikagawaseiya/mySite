<?php
$title = 'ギャラリー その３を投稿しました';
$date = '2026-09-21';
$this->displayBlogHead($title);
?>
<main class="main-content">
  <div>
    <?php echo Common::h($date); ?>
  </div>
  <h1><?php echo Common::h($title); ?></h1>
  <div>
    <p>
      前回に引き続き、新しいギャラリーページを作成しました。この頃は寒い時期だったのか、一緒に過ごしている写真が多いです。
    </p>
    <a class="top-space">
      また、当サイト内部のソースコードをいくつか修正しました。
      取引先の会社の方にコードレビューを行って頂いたので、それを参考に修正を行っています。<br>
      知らないツールの教授や、自身では抜けていた視点の指摘をくださり、非常に勉強になりました。本当に感謝申し上げます。
    </a>
  </div>
</main>
<?php showFooter(); ?>