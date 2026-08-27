export const BALL_RADIUS = 10;
const START_DX_SPEED = 1;
const START_DY_SPEED = 1;
const START_COLOR_NUMBER = 240;
let canvas;
let startX;
let startY;
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
    this.ballColorStyle = `hsl(${START_COLOR_NUMBER}, 70%, 60%)`;
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
   * ボールの色をランダムに変更する
   */
  changeBallColorRandom() {
    let randomColor = Math.floor(Math.random() * 360);
    this.ballColorStyle = `hsl(${randomColor}, 70%, 60%)`;
  }

  /**
  *ボール速度を変更する
  *パドル反射時に呼び出す
  */
  changeSpeedForPaddleReflection() {
    const BALL_MAX_SPEED_LIMIT = 3;
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
  drawRestartPosition() {
    this.x = this.startX;
    this.y = this.startY;
    this.dx = START_DX_SPEED;
    this.dy = START_DY_SPEED;
  }
}