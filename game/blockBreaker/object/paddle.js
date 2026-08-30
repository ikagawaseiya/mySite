//パドルの描画設定
const PADDLE_HEIGHT = 10;
const PADDLE_WIDTH = 75;
const PADDLE_SPEED = 7;

/**
 * パドルクラス
 * パドルの描画と、移動の処理を持つ
 */
export class Paddle {
  //コンストラクタ
  constructor(CANVAS) {
    this.startX = (CANVAS.width - PADDLE_WIDTH) / 2;
    this.canvas = CANVAS;
    this.paddleX = this.startX;
    this.rightPressed = false;
    this.leftPressed = false;
    this.Height = 10;
    this.Width = 75;
    this.rect = this.canvas.getBoundingClientRect();
    //拡大比率に合わせた画面のX軸
    this.scaleX = this.canvas.width / this.rect.width;
  }

  //パドルの描画
  draw(CTX) {
    CTX.beginPath();
    CTX.rect(this.paddleX, this.canvas.height - PADDLE_HEIGHT, PADDLE_WIDTH, PADDLE_HEIGHT);
    CTX.fillStyle = "white";
    CTX.fill();
    CTX.closePath();
  }

  //パドルの移動設定
  move() {
    if (this.rightPressed) {
      this.paddleX = Math.min(this.paddleX + PADDLE_SPEED, this.canvas.width - PADDLE_WIDTH);
    } else if (this.leftPressed) {
      this.paddleX = Math.max(this.paddleX - PADDLE_SPEED, 0);
    }
  }


  /*
  *キーボード入力時の処理を行う
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
  *キーボード非入力時の処理を行う
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
  *マウス入力時の移動処理を行う
  */
  mouseMoveHandler(e) {
    const RELATIVE_X = (e.clientX - this.rect.left) * this.scaleX;
    const LIMIT_SCREEN_EDGE_X = Math.max(0, Math.min(RELATIVE_X - this.Width / 2, this.canvas.width - this.Width));
    if (RELATIVE_X > 0 && RELATIVE_X < this.canvas.width) {
      this.paddleX = LIMIT_SCREEN_EDGE_X;
    }
  }

  /*
  *タッチ操作での移動処理 
  */
  touchMoveHandler(e) {
    const FIRST_TOUCH_POINT = e.touches[0];
    const RELATIVE_X_FOR_FIRST_TOUCH = (FIRST_TOUCH_POINT.clientX - this.rect.left) * this.scaleX;
    const LIMIT_SCREEN_EDGE_X = Math.max(0, Math.min(RELATIVE_X_FOR_FIRST_TOUCH - this.Width / 2, this.canvas.width - this.Width));
    this.paddleX = LIMIT_SCREEN_EDGE_X;
  };


  /**
   * 初期状態にリセットする
   */
  reset() {
    this.paddleX = this.startX;
    this.rightPressed = false;
    this.leftPressed = false;
  }
}