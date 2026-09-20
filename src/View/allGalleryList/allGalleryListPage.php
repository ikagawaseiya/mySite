<?php

/**
 * @var string $titleInHtml HTMLのtitleに入れるタイトル
 * @var string $pageTitle 
 * @var array $galleryPosts 新着順のギャラリーページ一覧
 */
?>

<link rel="stylesheet" href="/public/css/allTypeListPage.css">
<title><?php echo Common::h($titleInHtml) ?> </title>
<?php renderPageStartAndShowHeader($pageTitle); ?>

<div>
  <main class="main-content">
    <h1><?php echo Common::h($pageTitle); ?></h1>
    <?php
    $DisplayingMonth = '';
    $isDisplayed = false;
    foreach ($galleryPosts as $post):
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

      <?php if ($isDisplayed): ?>
        </ul>
      <?php endif; ?>
  </main>
</div>
<?php showFooter(); ?>