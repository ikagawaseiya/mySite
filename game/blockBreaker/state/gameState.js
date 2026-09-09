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
  /**
   * コンストラクタ
   * 初期状態はタイトルとする
   */
  constructor() {
    const INITIAL_STATE = STATE_TYPE.TITLE;
    this.state = INITIAL_STATE;
  }

  /**タイトル状態とする */
  setTitle() {
    this.state = STATE_TYPE.TITLE;
  }

  /**実行中状態とする */
  setRun() {
    this.state = STATE_TYPE.RUN;
  }

  /**ゲームオーバー状態とする */
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
  transitionTitleScreenForResultScreen() {
    if (this.isGameOver() || this.isGameClear()) {
      this.setTitle();
    }
  }

  /**タイトル画面である場合、実行中状態とする */
  runGameForTitle(SOUND, resetObject) {
    if (this.isTitle()) {
      SOUND.gameStart();
      resetObject();
      this.setRun();
    }
  }
}