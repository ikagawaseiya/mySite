const BALL_REFRECTION = new Audio('/game/blockBreaker/sound/ballRefrection.mp3');
const BRICK_BREAK = new Audio('/game/blockBreaker/sound/brickBreak.mp3');
const LIFE_LOSE = new Audio('/game/blockBreaker/sound/lifeLose.mp3');
const GAME_CLEAR = new Audio('/game/blockBreaker/sound/gameClear.mp3');
const GAME_OVER = new Audio('/game/blockBreaker/sound/gameOver.mp3');

// 音量（0.0 〜 1.0）
BALL_REFRECTION.volume = 0.3;

export class Sound {
  /**ボールの反射音 */
  ballRefrection() {
    BALL_REFRECTION.currentTime = 0;
    BALL_REFRECTION.play();
  }

  /**レンガの破壊音 */
  brickBreak() {
    BRICK_BREAK.currentTime = 0;
    BRICK_BREAK.play();
  }

  /**ライフ減少 */
  lifeLose() {
    LIFE_LOSE.currentTime = 0;
    LIFE_LOSE.play();
  }

  /**ゲームクリア */
  gameClear() {
    GAME_CLEAR.currentTime = 0;
    GAME_CLEAR.play();
  }

  /**ゲームオーバー */
  gameOver() {
    GAME_OVER.currentTime = 0;
    GAME_OVER.play();
  }
}