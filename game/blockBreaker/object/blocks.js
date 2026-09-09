/**難易度：NORMALの配置 */
const NORMAL_ROW_COUNT = 4;
const NORMAL_COLUMUN_COUNT = 10;
const NORMAL_WIDTH = 32;
const NORMAL_HEIGHT = 20;
const NORMAL_PADDING = 10;
const NORMAL_OFFSET_TOP = 30;
const NORMAL_OFSET_LEFT = 35;
/**難易度：HARDの配置 */
const HARD_ROW_COUNT = 5;
const HARD_COLUMUN_COUNT = 20;
const HARD_WIDTH = 16;
const HARD_HEIGHT = 16;
const HARD_PADDING = 5;
const HARD_OFFSET_TOP = 30;
const HARD_OFSET_LEFT = 32;


/**
 * ブロッククラス
 * ブロックの描画と、破壊判定に関する処理を持つ
 */
export class Blocks {
  //コンストラクタ
  constructor(CANVAS, DIFFICULTY) {
    this.canvas = CANVAS;
    this.blockRowCount = NORMAL_ROW_COUNT;
    this.blockColumnCount = NORMAL_COLUMUN_COUNT;
    this.blockWidth = NORMAL_WIDTH;
    this.blockHeight = NORMAL_HEIGHT;
    this.blockPadding = NORMAL_PADDING;
    this.blockOffsetTop = NORMAL_OFFSET_TOP;
    this.blockOffsetLeft = NORMAL_OFSET_LEFT;
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
    this.difficulty = DIFFICULTY;
  }

  /*
  *ブロックを並べて配置する
  *statusが1ではない(破壊された)ものは表示しない
  */
  draw(CTX) {
    for (let c = 0; c < this.blockColumnCount; c++) {
      for (let r = 0; r < this.blockRowCount; r++) {
        if (this.blocks[c][r].status == this.blockStartHp) {
          let blockX = (c * (this.blockWidth + this.blockPadding)) + this.blockOffsetLeft;
          let blockY = (r * (this.blockHeight + this.blockPadding)) + this.blockOffsetTop;
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
  *難易度を反映させる
  *その後、ブロックを配置し直す
  */
  restart() {
    if (this.difficulty.isNormal()) {
      this.blockRowCount = NORMAL_ROW_COUNT;
      this.blockColumnCount = NORMAL_COLUMUN_COUNT;
      this.blockWidth = NORMAL_WIDTH;
      this.blockHeight = NORMAL_HEIGHT;
      this.blockPadding = NORMAL_PADDING;
      this.blockOffsetTop = NORMAL_OFFSET_TOP;
      this.blockOffsetLeft = NORMAL_OFSET_LEFT;
    }
    else if (this.difficulty.isHard()) {
      this.blockRowCount = HARD_ROW_COUNT;
      this.blockColumnCount = HARD_COLUMUN_COUNT;
      this.blockWidth = HARD_WIDTH;
      this.blockHeight = HARD_HEIGHT;
      this.blockPadding = HARD_PADDING;
      this.blockOffsetTop = HARD_OFFSET_TOP;
      this.blockOffsetLeft = HARD_OFSET_LEFT;
    }

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

  /**
   * 開始時の総数を返す
   * @returns  開始時のブロックの総数
   */
  getStartTotalNumber() {
    return this.blockRowCount * this.blockColumnCount;
  }
}