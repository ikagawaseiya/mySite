
/**
 * インプットマネージャー
 * 入力に対する処理を管理する
 */
export const INPUT_MANAGER = {
  /**入力のチェック及び、それに対する処理を行う */
  checkInput(CANVAS, GAME_STATE, PADDLE, resetObject, TOUCH_AREA, SOUND) {

    /*
    *以下の状態におけるクリックされた場合の処理
    *状態に応じて、処理が異なる
    *
    *1.タイトル状態
    *ゲームを起動する
    *
    *2.ゲームオーバーまたはクリア状態
    *状態をタイトルとする
    */
    CANVAS.addEventListener("click", () => {
      if (GAME_STATE.isTitle()) {
        SOUND.gameStart();
        resetObject();
        GAME_STATE.setRun();
      }
      else if (GAME_STATE.isGameOver() || GAME_STATE.isGameClear()) {
        GAME_STATE.setTitle();
      }
    });

    /*キーボード:入力*/
    document.addEventListener("keydown", (e) => {
      if (GAME_STATE.isRunning()) {
        PADDLE.keyDownHandler(e);
      }
    }, false);

    /*キーボード:未入力*/
    document.addEventListener("keyup", (e) => {
      if (GAME_STATE.isRunning()) {
        PADDLE.keyUpHandler(e);
      }
    }, false);

    /**
    * マウス入力
    */
    document.addEventListener("pointermove", (e) => {
      if (GAME_STATE.isRunning()) {
        if (e.pointerType === "mouse") {
          PADDLE.mouseMoveHandler(e);
        }
      }
    }, false);

    /*
     *タッチエリア入力 
     */
    if (TOUCH_AREA) {
      // エリアに指が触れたとき
      TOUCH_AREA.addEventListener("touchstart", (e) => {
        e.preventDefault();
        TOUCH_AREA.classList.add("active");
        PADDLE.touchMoveHandler(e);
      }, { passive: false });

      // スライドの場合
      TOUCH_AREA.addEventListener("touchmove", (e) => {
        e.preventDefault();
        PADDLE.touchMoveHandler(e);
      }, { passive: false });

      // 未入力の場合
      TOUCH_AREA.addEventListener("touchend", (e) => {
        e.preventDefault();
        TOUCH_AREA.classList.remove("active");
      }, { passive: false });
    }
  }
}