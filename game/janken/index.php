<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>イベントジャンケン</title>
  <link rel="stylesheet" href="/game/janken/css/janken.css">
</head>

<body>
  <div id="game-display">
    <canvas id="myCanvas" width="360" height="640"></canvas>
  </div>
  <script type="module" src="/game/blockBreaker/gameManager.js"></script>
</body>

</html>