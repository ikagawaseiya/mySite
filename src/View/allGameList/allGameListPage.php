<?php

/**
 * @var array $cssPaths ページごとに付与する、CSSの配列
 * @var string $pageTitle 
 * @var array $gamePosts 新着順のゲームページ一覧
 */
?>
<?php showHeader($pageTitle, $cssPaths); ?>

<div>
  <main class="main-content">
    <?php
    $DisplayingMonth = '';
    $isDisplayed = false;
    foreach ($gamePosts as $post):
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