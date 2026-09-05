const GAME_OVER = document.getElementById("game-over-screen");
let gameState = null;
let sound = null;
let resetObject = null;
let touchArea = null;

/**ゲームオーバー画面 */
export const GAME_OVER_SCREEN = {
  /**初期化 */
  init(dependencies) {
    gameState = dependencies.gameState;
    sound = dependencies.sound;
    resetObject = dependencies.resetObject;
    touchArea = dependencies.touchArea;
    this.setupEvents();
  },

  /**表示 */
  show(score, totalBlockNum) {
    if (GAME_OVER) {
      document.querySelector('.game-score').textContent = score;
      document.querySelector('.total-block-num').textContent = totalBlockNum;
      GAME_OVER.style.display = "flex";
    }
  },

  /**非表示 */
  hide() {
    if (GAME_OVER) GAME_OVER.style.display = "none";
  },


  /**
   * 各種イベントをセットアップする 
   * 入力に対する処理は、この中に記載する
   * */
  setupEvents() {

    /**画面のタッチでタイトル画面に戻る */
    GAME_OVER?.addEventListener("click", () => {
      if (gameState.isGameOver()) {
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
      if (gameState.isGameOver()) {
        this.hide();
        gameState.transitionTitleScreenForResultScreen(sound, resetObject)
      }
    }, { passive: false });*/
  }
}