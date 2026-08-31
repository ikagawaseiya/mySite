<?php
$title = 'JavaScriptでブロック崩しを制作しました';
$date = '2026-08-30';
$this->displayBlogHead($title);
?>
<main class="main-content">
  <div>
    <?php echo Common::h($date); ?>
  </div>
  <h1><?php echo Common::h($title); ?></h1>
  <p>JavaScriptでブロック崩しゲームを制作しました。<br>
    <a href="https://cute-rabbit.sakura.ne.jp/game/blockBreaker/" class="link-button">
      <span class="link-button-text">BLOCK BREAKER</span>
    </a>
  <p>
    内容としては<a href="https://developer.mozilla.org/ja/docs/Games/Tutorials/2D_Breakout_game_pure_JavaScript">
      MDN 純粋な JavaScript を使った二次元ブロック崩しゲーム
    </a>
    をベースとし、デザインの変更や機能の追加を行ったものになります。<br>
    初めてのゲーム制作でしたが、思いついた機能を組み込むのが想像より大変だったので、練習として取り組んで良かったです。
  <div class="top-space">
    スマホのタッチ操作にも対応したのですが、何故かiphoneだと挙動が重くなる不具合があるので後々修正する予定です。
    動作を見た感じではサウンドの再生処理に問題があるように思えますが、詳細はまた調べます。
  </div>
  <div class="top-space">
    また、効果音は<a href="https://soundeffect-lab.info/">効果音ラボ</a>
    様からお借りしました。
    心よりお礼申し上げます。
  </div>
  </p>
</main>
<?php showFooter(); ?>