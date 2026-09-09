import { TITLE_SCREEN } from '/game/blockBreaker/screen/title/titleScreen.js';
import { GAME_OVER_SCREEN } from '/game/blockBreaker/screen/gameOver/gameOverScreen.js';
import { GAME_CLEAR_SCREEN } from '/game/blockBreaker/screen/gameClear/gameClearScreen.js';
import { setupSound, Sound } from '/game/blockBreaker/sound/sound.js';
import { GameState, STATE_TYPE } from '/game/blockBreaker/state/gameState.js';
import { Difficulty } from '/game/blockBreaker/state/difficulty.js';
import { Ball } from '/game/blockBreaker/object/ball.js';
import { Paddle } from '/game/blockBreaker/object/paddle.js';
import { Blocks } from '/game/blockBreaker/object/blocks.js';
import { Lives } from '/game/blockBreaker/object/lives.js';
import { Score } from '/game/blockBreaker/object/score.js';
import { Timer } from '/game/blockBreaker/object/timer.js';

/**キャンバス */
const CANVAS = document.getElementById("myCanvas");
/**描画コンテキスト */
const CTX = CANVAS.getContext("2d");
/**音声とその初期化 */
await setupSound();
const SOUND = new Sound();
/**ゲームの状態 */
const GAME_STATE = new GameState();
/**難易度 */
const DIFFICULTY = new Difficulty();
/**タッチエリア */
const TOUCH_AREA = document.getElementById("paddle-touch-area");

/**スクリーンの初期化 */
const FIXED_SCREENS = [GAME_OVER_SCREEN, GAME_CLEAR_SCREEN];
FIXED_SCREENS.forEach(screen => {
  screen.init({
    gameState: GAME_STATE,
    sound: SOUND,
    resetObject: resetObject,
    touchArea: TOUCH_AREA
  });
});

TITLE_SCREEN.init({
  gameState: GAME_STATE,
  sound: SOUND,
  resetObject: resetObject,
  touchArea: TOUCH_AREA,
  difficulty: DIFFICULTY
})

//各オブジェクトの生成
const BALL = new Ball(CANVAS);
const PADDLE = new Paddle(CANVAS);
const BLOCKS = new Blocks(CANVAS);
const LIVES = new Lives(CANVAS);
const SCORE = new Score(CANVAS);
const TIMER = new Timer(CANVAS);
const OBJECTS = [BALL, PADDLE, BLOCKS, LIVES, SCORE, TIMER];

/*
 *各オブジェクトを描画する
*/
function drawGameObjects() {
  OBJECTS.forEach(object => {
    object.draw(CTX);
  });
}

/*
 *各オブジェクトの状態を初期状態に戻す
*/
function resetObject() {
  OBJECTS.forEach(object => {
    object.reset();
  });
}

/**
 * ゲームの実行
*/
function runGame() {
  drawGameObjects();
  TIMER.run();
  BALL.move(PADDLE,
    BLOCKS,
    SCORE,
    LIVES,
    GAME_STATE,
    SOUND);
  PADDLE.move();
}

/**
 *ゲームの状態により、
 *それを表す画面を描写する
*/
function draw() {
  CTX.clearRect(0, 0, CANVAS.width, CANVAS.height);
  switch (GAME_STATE.state) {
    case STATE_TYPE.TITLE:
      TITLE_SCREEN.show(DIFFICULTY.type);
      break;

    case STATE_TYPE.RUN:
      runGame();
      break;

    case STATE_TYPE.GAME_OVER:
      TIMER.stop();
      drawGameObjects();
      GAME_OVER_SCREEN.show(SCORE.score, BLOCKS.getStartTotalNumber());
      break;

    case STATE_TYPE.GAME_CLEAR:
      TIMER.stop();
      drawGameObjects();
      GAME_CLEAR_SCREEN.show(TIMER.minutes, TIMER.seconds);
      break;
  }

  // requestAnimationFrame()により、繰り返される
  requestAnimationFrame(draw);
}


import { INPUT_MANAGER } from '/game/blockBreaker/input/inputManager.js';
INPUT_MANAGER.checkInput(GAME_STATE, PADDLE, TOUCH_AREA);

draw();