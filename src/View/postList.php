<?php if ($loopCount > 0): ?>
  <ul>
    <?php for ($i = 0; $i < $loopCount; $i++): $post = $blogPosts[$i]; ?>
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