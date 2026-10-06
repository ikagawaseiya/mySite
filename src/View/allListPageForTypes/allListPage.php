<?php

/**
 * そのページ種別における全ページを格納した配列を受け取る
 * 配列内の各ページ毎に、以下の情報がそれぞれ存在する
 * ・URL
 * ・日時
 * ・ページ名
 * 
 * それら各ページを、新しい順に並べて一覧表示する
 * 
 * TODO　将来的に項目が増えすぎた場合、ページを分割する等見やすくする必要あり？
 * 
 * @var array $cssPaths ページごとに付与する、CSSの配列
 * @var string $pageTitle ページのタイトル 「ページの種別名＋一覧」となる
 * @var array $posts 新着順のブログページ一覧
 */
?>
<?php showHeader($pageTitle, $cssPaths); ?>

<div>
  <main class="main-content">
    <?php
    $DisplayingMonth = '';
    $isDisplayed = false;
    foreach ($posts as $post):
      $isDisplayed = $DisplayingMonth !== '';
      $postMonth = date('Y年m月', strtotime($post['date']));
      $isDisplayingUpdate = $DisplayingMonth !== $postMonth;

      if ($isDisplayingUpdate):

        if ($isDisplayed): ?>
          </ul>
        <?php endif; ?>

        <h2><?php echo Common::h($postMonth); ?></h2>
        <ul>
        <?php
        $DisplayingMonth = $postMonth;
      endif;

        ?>
        <li>
          <a href="<?php echo Common::h($post['url']); ?>">
            <?php echo Common::h($post['title']); ?>
          </a>
        </li>

      <?php endforeach; ?>

      <?php
      if ($DisplayingMonth !== ''): ?>
        </ul>
      <?php endif; ?>
  </main>
</div>
<?php showFooter(); ?>