//パドルの描画設定
const PADDLE_HEIGHT = 10;
const PADDLE_WIDTH = 75;

export class Paddle {
  //コンストラクタ
  constructor(CANVAS) {
    this.canvas = CANVAS;
    this.paddleX = (CANVAS.width - PADDLE_WIDTH) / 2;
    this.rightPressed = false;
    this.leftPressed = false;
  }

  //パドルの描画
  drawPaddle(CTX) {
    CTX.beginPath();
    CTX.rect(this.paddleX, this.canvas.height - PADDLE_HEIGHT, PADDLE_WIDTH, PADDLE_HEIGHT);
    CTX.fillStyle = "#0095DD";
    CTX.fill();
    CTX.closePath();
  }

  //パドルの移動設定
  move() {
    if (this.rightPressed) {
      this.paddleX = Math.min(this.paddleX + 7, this.canvas.width - PADDLE_WIDTH);
    } else if (this.leftPressed) {
      this.paddleX = Math.max(this.paddleX - 7, 0);
    }
  }


  /*
  *キーボード入力を検知する
  *作動処理
  */
  keyDownHandler(e) {
    if (e.key === "Right" || e.key === "ArrowRight") {
      this.rightPressed = true;
    } else if (e.key === "Left" || e.key === "ArrowLeft") {
      this.leftPressed = true;
    }
  }

  /*
  *キーボード非入力を検知する
  *停止処理
  */
  keyUpHandler(e) {
    if (e.key === "Right" || e.key === "ArrowRight") {
      this.rightPressed = false;
    } else if (e.key === "Left" || e.key === "ArrowLeft") {
      this.leftPressed = false;
    }
  }

  /*
  *マウス入力を検知する
  */
  mouseMoveHandler(e) {
    const relativeX = e.clientX - this.canvas.offsetLeft;
    if (relativeX > 0 && relativeX < CANVAS.width) {
      this.paddleX = relativeX - PADDLE_WIDTH / 2;
    }
  }
}