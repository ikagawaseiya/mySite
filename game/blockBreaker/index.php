<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <title>ブロック崩しゲーム</title>
  <link rel="stylesheet" href="/game/blockBreaker/css/blockBreaker.css">
</head>

<body>
  <div id="game-display">
    <canvas id="myCanvas" width="480" height="320"></canvas>
    <?php include __DIR__ . '/screen/title/titleScreen.html'; ?>
  </div>
  <div id="paddle-touch-area" class="paddle-touch-area">
    Touch Area☝&#xFE0E;
  </div>
  <script type="module" src="/game/blockBreaker/gameManager.js"></script>
</body>

</html>