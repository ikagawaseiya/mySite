/**
 * タイマークラス
 * クリアまでの時間を計測し、表示する処理を持つ
 */
export class Timer {
  constructor(CANVAS) {
    this.canvas = CANVAS;
    this.startTime = performance.now();
    this.elapsedTime = 0;
    this.isStop = false;
  }

  /** タイマーの描画 */
  draw(CTX) {
    CTX.font = "16px Arial";
    CTX.fillStyle = "white";
    CTX.textAlign = "center";

    const minutes = Math.floor(this.elapsedTime / 60).toString().padStart(2, '0');
    const seconds = Math.floor(this.elapsedTime % 60).toString().padStart(2, '0');
    CTX.fillText(`${minutes}:${seconds}`, this.canvas.width / 2, 20);
  }

  /**
   * タイマーを起動する
   * それによって、経過時間を更新する
   */
  run() {
    if (this.isStop) { return; }
    const CONVATE_SECONDS_VALUE = 1000;
    this.elapsedTime = (performance.now() - this.startTime) / CONVATE_SECONDS_VALUE;
  }

  /**
   * タイマーを止める
   */
  stop() {
    this.isStop = true;
  }

  /**
   * タイムを初期値にリセットする
   */
  reset() {
    this.startTime = performance.now();
    this.elapsedTime = 0;
    this.isStop = false;
  }


}