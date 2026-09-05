<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ブロック崩しゲーム</title>
  <link rel="stylesheet" href="/game/blockBreaker/css/blockBreaker.css">
  <link rel="stylesheet" href="/game/blockBreaker/screen/title/titleScreen.css">
  <link rel="stylesheet" href="/game/blockBreaker/screen/gameOver/gameOverScreen.css">
  <link rel="stylesheet" href="/game/blockBreaker/screen/gameClear/gameClearScreen.css">
</head>

<body>
  <div id="game-display">
    <canvas id="myCanvas" width="480" height="320"></canvas>
    <?php include_once __DIR__ . '/screen/title/titleScreen.html'; ?>
    <?php include_once __DIR__ . '/screen/gameOver/gameOverScreen.html'; ?>
    <?php include_once __DIR__ . '/screen/gameClear/gameClearScreen.html' ?>
  </div>
  <div id="paddle-touch-area" class="paddle-touch-area">
    Touch Area☝&#xFE0E;
  </div>
  <script type="module" src="/game/blockBreaker/gameManager.js"></script>
</body>

</html>