const TITLE = document.getElementById("title-screen");
let gameState = null;
let sound = null;
let resetObject = null;
let touchArea = null;

/**タイトル画面 */
export const TITLE_SCREEN = {
  /**初期化 */
  init(dependencies) {
    gameState = dependencies.gameState;
    sound = dependencies.sound;
    resetObject = dependencies.resetObject;
    touchArea = dependencies.touchArea;
    this.setupEvents();
  },

  /**表示 */
  show() {
    if (TITLE) TITLE.style.display = "flex";
  },

  /**非表示 */
  hide() {
    if (TITLE) TITLE.style.display = "none";
  },

  /**ゲーム開始 */
  gameStart() {
    gameState.runGameForTitle(sound, resetObject);
    this.hide();
  },

  /**
   * 各種イベントをセットアップする 
   * 入力に対する処理は、この中に記載する
   * */
  setupEvents() {
    /**ゲーム起動 */
    TITLE?.addEventListener("click", () => {
      if (gameState.isTitle()) {
        this.gameStart();
      }
    });

    /**トップページに戻る */
    TITLE?.querySelector('.top-page-back-button')?.addEventListener("click", (event) => {
      event.stopPropagation();
      location.href = "/";
    });

    /**
     * タッチエリア入力 
     * 
     * スマートフォンでは最初のタッチで音が鳴らないため、離したタイミングを入力とする
     * */
    touchArea.addEventListener("touchend", (e) => {
      if (gameState.isTitle()) {
        this.gameStart();
      }
    }, { passive: false });
  }
};