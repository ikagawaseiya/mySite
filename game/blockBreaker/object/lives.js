const START_LIVES = 3;

/**
 * 命クラス
 * プレイヤーがミスできる回数（命）を扱うクラス
 */
export class Lives {
  /**コンストラクタ */
  constructor(CANVAS) {
    this.canvas = CANVAS;
    this.lives = START_LIVES;
  }

  //ライフの描画
  draw(CTX) {
    CTX.font = "16px Arial";
    CTX.fillStyle = "white";
    CTX.textAlign = "left";
    const heartText = "❤".repeat(this.lives);
    CTX.fillText(heartText, 20, 20);
  }

  /**
   * ひとつ失った場合の処理
   */
  lose() {
    this.lives--;
  }

  /**
   * 初期値にリセットする
   */
  reset() {
    this.lives = START_LIVES;
  }

  /**
   * ゲームオーバーであるかを返す
   * @returns ゲームオーバー / ゲームオーバーではない
   */
  isGameOver() {
    return this.lives <= 0;
  }
} 