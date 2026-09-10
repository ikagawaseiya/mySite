const TITLE = document.getElementById("title-screen");
const DIFFICULTY = document.querySelector(".difficulty");
let gameState = null;
let sound = null;
let restartObject = null;
let touchArea = null;
let difficulty = null;

/**タイトル画面 */
export const TITLE_SCREEN = {
  /**初期化 */
  init(dependencies) {
    gameState = dependencies.gameState;
    sound = dependencies.sound;
    restartObject = dependencies.restartObject;
    touchArea = dependencies.touchArea;
    difficulty = dependencies.difficulty;
    this.setupEvents();
  },

  /**表示 */
  show() {
    DIFFICULTY.textContent = difficulty.type;
    if (TITLE) TITLE.style.display = "flex";
  },

  /**非表示 */
  hide() {
    if (TITLE) TITLE.style.display = "none";
  },

  /**ゲーム開始 */
  gameStart() {
    gameState.runGameForTitle(sound, restartObject);
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

    /**
     * 難易度選択エリアのクリック
     * ゲームが起動しないように、親要素へのイベント伝搬を停止する
     * */
    TITLE?.querySelector('.difficulty-selector')?.addEventListener("click", (event) => {
      event.stopPropagation();
    });

    /**難易度変更ボタン：ひとつ下げる */
    TITLE?.querySelector('.low-difficulty-button')?.addEventListener("click", (event) => {
      difficulty.setLowOneLevel();
    });

    /**難易度変更ボタン：ひとつ上げる */
    TITLE?.querySelector('.high-difficulty-button')?.addEventListener("click", (event) => {
      difficulty.setHighOneLevel();
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