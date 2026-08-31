const BALL_REFLECTION = new Audio('/game/blockBreaker/sound/se/ballReflection.mp3');
const BRICK_BREAK = new Audio('/game/blockBreaker/sound/se/blockBreak.mp3');
const LIFE_LOSE = new Audio('/game/blockBreaker/sound/se/lifeLose.mp3');
const GAME_CLEAR = new Audio('/game/blockBreaker/sound/se/gameClear.mp3');
const GAME_OVER = new Audio('/game/blockBreaker/sound/se/gameOver.mp3');
const GAME_START = new Audio('/game/blockBreaker/sound/se/gameStart.mp3');

/**
 * サウンドクラス
 * 音に関する処理を持つ  
 */
export class Sound {
  /**ボールの反射音 */
  ballReflection() {
    BALL_REFLECTION.currentTime = 0;
    BALL_REFLECTION.play();
  }

  /**レンガの破壊音 */
  blockBreak() {
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

  /**ゲームスタート*/
  gameStart() {
    GAME_START.currentTime = 0;
    GAME_START.play();
  }
}