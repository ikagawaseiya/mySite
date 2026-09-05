const GAME_CLEAR = document.getElementById("game-clear-screen");
let gameState = null;
let sound = null;
let resetObject = null;
let touchArea = null;

/**ゲームクリア画面 */
export const GAME_CLEAR_SCREEN = {
  /**初期化 */
  init(dependencies) {
    gameState = dependencies.gameState;
    sound = dependencies.sound;
    resetObject = dependencies.resetObject;
    touchArea = dependencies.touchArea;
    this.setupEvents();
  },

  /**表示 */
  show(clearMinute, clearSecond) {
    if (GAME_CLEAR) {
      document.querySelector('.clear-minute').textContent = clearMinute;
      document.querySelector('.clear-second').textContent = clearSecond;
      GAME_CLEAR.style.display = "flex";
    }
  },

  /**非表示 */
  hide() {
    if (GAME_CLEAR) GAME_CLEAR.style.display = "none";
  },


  /**
   * 各種イベントをセットアップする 
   * 入力に対する処理は、この中に記載する
   * */
  setupEvents() {

    /**画面のタッチでタイトル画面に戻る */
    GAME_CLEAR?.addEventListener("click", () => {
      if (gameState.isGameClear()) {
        this.hide();
        gameState.transitionTitleScreenForResultScreen(sound, resetObject)
      }
    });

    /**
     * タッチエリア入力 
     * 
     * 離したタイミングを入力とし、
     * タイトル画面に戻る
     * TODO 誤作動するので仕様を変える予定
     * */
    /*
    touchArea.addEventListener("touchend", (e) => {
      if (gameState.isGameClear()) {
        this.hide();
        gameState.transitionTitleScreenForResultScreen(sound, resetObject)
      }
    }, { passive: false });
    */
  }
}