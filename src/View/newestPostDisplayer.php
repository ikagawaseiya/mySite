<?php if (NEWEST_PAGE_LOOP_COUNT > 0): ?>
  <ul class="new-articles">
    <?php for ($i = 0; $i < NEWEST_PAGE_LOOP_COUNT; $i++): $post = $newestPosts[$i]; ?>
      <li>
        <a href="<?php echo Common::h($post['url']); ?>">
          <?php $displayPageTitle = Common::generateDisplayTitleAndDate($post['title'], $post['date']); ?>
          <?php echo Common::h($displayPageTitle); ?>
        </a>
      </li>
    <?php endfor; ?>
  </ul>
<?php else: ?>
  <p>記事はありません。</p>
<?php endif; ?>