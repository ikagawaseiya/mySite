
/**
 * インプットマネージャー
 * 入力に対する処理を管理する
 */
export const INPUT_MANAGER = {
  /**入力のチェック及び、それに対する処理を行う */
  checkInput(CANVAS, GAME_STATE, PADDLE) {

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
     * TODO　スマホ実装に伴って削除するかも？
    */
    document.addEventListener("mousemove", (e) => {
      if (GAME_STATE.isRunning()) {
        PADDLE.mouseMoveHandler(e);
      }
    }, false);
  }

}