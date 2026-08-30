
/**
 * ブロッククラス
 * ブロックの描画と、破壊判定に関する処理を持つ
 */
export class Blocks {
  //コンストラクタ
  constructor(CANVAS) {
    this.canvas = CANVAS;
    this.blockRowCount = 4;
    this.blockColumnCount = 10;
    this.blockWidth = 32;
    this.blockHeight = 20;
    this.blockPadding = 10;
    this.blockOffsetTop = 30;
    this.blockOffsetLeft = 30;
    this.blockStartHp = 1;
    this.blockDestroyHp = 0;
    this.blocks = [];
    for (let c = 0; c < this.blockColumnCount; c++) {
      this.blocks[c] = [];
      for (let r = 0; r < this.blockRowCount; r++) {
        //ひとつひとつのブロックが持つ値
        this.blocks[c][r] = {
          x: 0,
          y: 0,
          status: this.blockStartHp,
          width: this.blockWidth,
          height: this.blockHeight
        };
      }
    }
  }

  /*
  *ブロックを並べて配置する
  *statusが1ではない(破壊された)ものは表示しない
  */
  draw(CTX) {
    for (var c = 0; c < this.blockColumnCount; c++) {
      for (var r = 0; r < this.blockRowCount; r++) {
        if (this.blocks[c][r].status == this.blockStartHp) {
          var blockX = (c * (this.blockWidth + this.blockPadding)) + this.blockOffsetLeft;
          var blockY = (r * (this.blockHeight + this.blockPadding)) + this.blockOffsetTop;
          this.blocks[c][r].x = blockX;
          this.blocks[c][r].y = blockY;
          CTX.beginPath();
          CTX.rect(blockX, blockY, this.blockWidth, this.blockHeight);
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
  *ブロックのHPを初期状態に戻す
  *リセット処理に使用する
  */
  reset() {
    for (let c = 0; c < this.blockColumnCount; c++) {
      for (let r = 0; r < this.blockRowCount; r++) {
        this.blocks[c][r].status = this.blockStartHp;
      }
    }
  }

  /**
   * 開始時の総数を返す
   * @returns  開始時のブロックの総数
   */
  getStartTotaleNumber() {
    return this.blockRowCount * this.blockColumnCount;
  }
}