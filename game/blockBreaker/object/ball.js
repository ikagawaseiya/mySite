export const BALL_RADIUS = 10;
const START_DX_SPEED = 1;
const START_DY_SPEED = 1;
const START_COLOR = `skyblue`;;
const BALL_MAX_SPEED_LIMIT = 4;

/**
 * ボールクラス
 */
export class Ball {
  /**
   * ボールのコンストラクタ
   */
  constructor(CANVAS) {
    this.canvas = CANVAS;
    this.startX = this.canvas.width / 2;
    this.startY = this.canvas.height / 2;

    this.x = this.startX;
    this.y = this.startY;
    this.dx = START_DX_SPEED;
    this.dy = START_DY_SPEED;
    this.ballColorStyle = START_COLOR;
  }

  /**
   * ボールを描画する
   * @param {*} CTX 描画するコンテキスト
   */
  draw(CTX) {
    CTX.beginPath();
    CTX.arc(this.x, this.y, BALL_RADIUS, 0, Math.PI * 2);
    CTX.fillStyle = this.ballColorStyle;
    CTX.fill();
    CTX.closePath();
  }

  /**
   * ボールの色を変更する
   * 水色と白で交互とする
   */
  changeBallColor() {
    if (this.ballColorStyle == "white") {
      this.ballColorStyle = START_COLOR;
    } else {
      this.ballColorStyle = "white";
    }
  }

  /**
  *ボール速度を変更する
  *パドル反射時に呼び出す
  *
  *最大速度を超えることは無い
  */
  changeSpeedForReflection() {
    if (this.dx < 0) {
      this.dx = Math.max(this.dx - 1, -BALL_MAX_SPEED_LIMIT);
    } else if (this.dx > 0) {
      this.dx = Math.min(this.dx + 1, BALL_MAX_SPEED_LIMIT);
    }
    if (this.dy < 0) {
      this.dy = Math.max(this.dy - 1, -BALL_MAX_SPEED_LIMIT);
    }
  }

  /**
   * リスタート位置に配置する
   */
  setRestartPosition() {
    this.x = this.startX;
    this.y = this.startY;
    this.dx = START_DX_SPEED;
    this.dy = START_DY_SPEED;
  }

  /*
  *キャンバス側面であるかを判定し、
  *そうである場合、dxを反転させることで反射させる
   */
  reflectionForCanvasSide() {
    if (this.x + this.dx > this.canvas.width - BALL_RADIUS || this.x + this.dx < BALL_RADIUS) {
      this.dx = -this.dx; this.changeBallColor();
    }
  }

  //キャンバスの最上部に触れたかを返す
  isCanvasTop() {
    return this.y + this.dy < BALL_RADIUS;
  }
}