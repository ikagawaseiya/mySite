
/**
 * レンガクラス
 * レンガの描画と、破壊判定に関する処理を持つ
 */
export class Bricks {
  //コンストラクタ
  constructor(CANVAS) {
    this.canvas = CANVAS;
    this.brickRowCount = 4;
    this.brickColumnCount = 10;
    this.brickWidth = 32;
    this.brickHeight = 20;
    this.brickPadding = 10;
    this.brickOffsetTop = 30;
    this.brickOffsetLeft = 30;
    this.brickStartHp = 1;
    this.brickDestroyHp = 0;
    this.bricks = [];
    for (let c = 0; c < this.brickColumnCount; c++) {
      this.bricks[c] = [];
      for (let r = 0; r < this.brickRowCount; r++) {
        //ひとつひとつのレンガが持つ値
        this.bricks[c][r] = {
          x: 0,
          y: 0,
          status: this.brickStartHp,
          width: this.brickWidth,
          height: this.brickHeight
        };
      }
    }
  }

  /*
  *ブロックを並べて配置する
  *statusが1ではない(破壊された)ものは表示しない
  */
  draw(CTX) {
    for (var c = 0; c < this.brickColumnCount; c++) {
      for (var r = 0; r < this.brickRowCount; r++) {
        if (this.bricks[c][r].status == this.brickStartHp) {
          var brickX = (c * (this.brickWidth + this.brickPadding)) + this.brickOffsetLeft;
          var brickY = (r * (this.brickHeight + this.brickPadding)) + this.brickOffsetTop;
          this.bricks[c][r].x = brickX;
          this.bricks[c][r].y = brickY;
          CTX.beginPath();
          CTX.rect(brickX, brickY, this.brickWidth, this.brickHeight);
          CTX.fillStyle = this.getBrickColor(r);
          CTX.fill();
          CTX.closePath();
        }
      }
    }
  }

  /**
   * 色を取得する
   * 列が奇数か偶数かで変更する
   * 
   * @param {*} r 列
   * @returns  色を指定する文字列
   */
  getBrickColor(r) {
    if (r % 2 === 0) {
      return "yellow";
    } else {
      return "white";
    }
  }

  /**
  *レンガのHPを初期状態に戻す
  *リセット処理に使用する
  */
  reset() {
    for (let c = 0; c < this.brickColumnCount; c++) {
      for (let r = 0; r < this.brickRowCount; r++) {
        this.bricks[c][r].status = this.brickStartHp;
      }
    }
  }

  /**
   * 開始時の総数を返す
   * @returns  開始時のレンガの総数
   */
  getStartTotaleNumber() {
    return this.brickRowCount * this.brickColumnCount;
  }
}