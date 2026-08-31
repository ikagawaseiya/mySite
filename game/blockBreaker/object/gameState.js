/**ステータスの種類 */
export const STATE_TYPE = Object.freeze({
  TITLE: 'title',
  RUN: 'playing',
  GAME_OVER: 'gameOver',
  GAME_CLEAR: 'gameClear'
});

/**
 * ゲームの状態クラス
 * ゲームのステータスを管理する 
 * */
export class GameState {
  constructor() {
    this.state = STATE_TYPE.TITLE;
  }

  /**タイトル */
  setTitle() {
    this.state = STATE_TYPE.TITLE;
  }

  /**実行中 */
  setRun() {
    this.state = STATE_TYPE.RUN;
  }

  /**ゲームオーバー */
  setGameOver() {
    this.state = STATE_TYPE.GAME_OVER;
  }

  /**ゲームクリア */
  setGameClear() {
    this.state = STATE_TYPE.GAME_CLEAR;
  }

  /**タイトル画面であるかを返す */
  isTitle() {
    return this.state === STATE_TYPE.TITLE;
  }

  /**実行中であるかを返す */
  isRunning() {
    return this.state === STATE_TYPE.RUN;
  }

  /**ゲームオーバーであるかを返す */
  isGameOver() {
    return this.state === STATE_TYPE.GAME_OVER;
  }

  /**ゲームクリアであるかを返す */
  isGameClear() {
    return this.state === STATE_TYPE.GAME_CLEAR;
  }

  /**
  *ゲームオーバーまたはクリア状態である場合、
  *状態をタイトルとする
  */
  switchStateForGameEndScreen(SOUND, resetObject) {
    if (this.isGameOver() || this.isGameClear()) {
      this.setTitle();
    }
  }

  /**タイトル画面である場合、ゲームを作動する */
  runGameForTitle(SOUND, resetObject) {
    if (this.isTitle()) {
      SOUND.gameStart();
      resetObject();
      this.setRun();
    }
  }
}