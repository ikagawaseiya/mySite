<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>無人島生活</title>
  <link rel="stylesheet" href="/game/uninhabitedIsland/css/uninhabitedIsland.css">
  <link rel="stylesheet" href="/game/uninhabitedIsland/screen/title/titleScreen.css">
</head>

<body>
  <div id="game-display">
    <canvas id="myCanvas" width="480" height="320"></canvas>
  </div>
  <script type="module" src="/game/uninhabitedIsland/gameManager.js"></script>
</body>

</html>