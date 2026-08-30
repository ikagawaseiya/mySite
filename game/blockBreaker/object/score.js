const START_SCORE = 0;
/**
 * スコアクラス
 * スコアに関わる処理を持つ
 */
export class Score {

  /** コンストラクタ*/
  constructor(CANVAS) {
    this.canvas = CANVAS;
    this.score = START_SCORE;
  }

  //スコアの描画
  draw(CTX) {
    CTX.font = "16px Arial";
    CTX.fillStyle = "white";
    CTX.textAlign = "right";
    CTX.fillText(`${this.score}`, this.canvas.width - 20, 20);
  }

  /**スコアをひとつ増やす */
  increase() {
    this.score++;
  }

  /**
   * ゲームをクリアしたか判定する
   * @return ゲームクリア / ゲームクリアではない
   */
  isGameClear(BLOCKS) {
    return this.score === BLOCKS.getStartTotaleNumber();
  }

  /**
   * スコアを初期値にリセットする
   */
  reset() {
    this.score = START_SCORE;
  }
}