export const BALL_RADIUS = 10;
const START_DX_SPEED = 1;
const START_DY_SPEED = 1;
const START_COLOR = `skyblue`;
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
    //移動速度 dx dy
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
   * フレームごとに行われる移動
   */
  move() {
    this.x += this.dx;
    this.y += this.dy;
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
  *
  *最大速度を超えることは無い
  */
  changeSpeedForReflection() {
    const CHANGE_SPEED_NUM = 3;
    if (this.dx < 0) {
      this.dx = Math.max(this.dx - CHANGE_SPEED_NUM, -BALL_MAX_SPEED_LIMIT);
    } else if (this.dx > 0) {
      this.dx = Math.min(this.dx + CHANGE_SPEED_NUM, BALL_MAX_SPEED_LIMIT);
    }
    if (this.dy < 0) {
      this.dy = Math.max(this.dy - CHANGE_SPEED_NUM, -BALL_MAX_SPEED_LIMIT);
    }
  }

  /**
   * リスタート位置に配置する
   */
  reset() {
    this.x = this.startX;
    this.y = this.startY;
    this.dx = START_DX_SPEED;
    this.dy = START_DY_SPEED;
  }

  /*
  *キャンバス側面であるかを判定し、
  *そうである場合、dxを反転させることで反射する
  *その後、ボールの色を変更する
  */
  checkReflectionForCanvasSide() {
    if (this.x + this.dx > this.canvas.width - BALL_RADIUS || this.x + this.dx < BALL_RADIUS) {
      this.dx = -this.dx;
      this.changeBallColor()
    }
  }

  /*
  *キャンバス頂点であるかを判定し、
  *そうである場合、dyを反転させることで反射する
  *その後、ボールの色を変更する
  */
  checkReflectionForCanvasTop() {
    if (this.isCanvasTop()) {
      this.dy = -this.dy;
      this.changeBallColor();
    }
  }

  //キャンバスの最上部に触れたかを返す
  isCanvasTop() {
    return this.y + this.dy < BALL_RADIUS;
  }

  /**
  *キャンバスの底であるかを判定し、
  *そうである場合、以下の場合に応じた処理を行う
  *
  * 1.パドルの当たり判定に存在する場合
  * パドルの当たり判定の頂点に移動し、dyを反転させることで反射する
  * 
  * 2.そうでない場合
  * 命を一つ失う
  * 命がなくなった場合、ゲームオーバーとする
  */
  checkReflectionForCanvasBottom(PADDLE, LIVES, GAME_STATE) {
    const PADDLE_Y = this.canvas.height - BALL_RADIUS - PADDLE.Height;
    const MARGIN_FOR_MISS = 5;
    if (this.y + this.dy > PADDLE_Y) {
      if (this.x > PADDLE.paddleX && this.x < PADDLE.paddleX + PADDLE.Width) {
        this.y = PADDLE_Y;
        this.dy = -this.dy;
        this.changeSpeedForReflection();
        this.changeBallColor();
      }
      else if (this.y + this.dy > this.canvas.height - BALL_RADIUS + MARGIN_FOR_MISS) {
        LIVES.lose();
        if (LIVES.isGameOver()) {
          GAME_STATE.setGameOver();
        } else {
          this.reset();
          PADDLE.reset();
        }
      }
    }
  }


  /*
  *レンガとの衝突判定
  *[c][r]それぞれののfor文によりブロックを特定
  *ボールの判定xyが重なった場合に衝突とする
  */
  checkBricksCollision(BRICKS, SCORE, GAME_STATE, SOUND) {
    for (var c = 0; c < BRICKS.brickColumnCount; c++) {
      for (var r = 0; r < BRICKS.brickRowCount; r++) {
        var brick = BRICKS.bricks[c][r];
        //衝突した場合の処理
        let isCollision = this.x > brick.x &&
          this.x < brick.x + BRICKS.brickWidth &&
          this.y > brick.y &&
          this.y < brick.y + BRICKS.brickHeight;
        if (brick.status == BRICKS.brickStartHp) {
          if (isCollision) {
            SOUND.brickBreak();
            this.dy = -this.dy;
            brick.status = BRICKS.brickDestroyHp;
            this.changeBallColor();
            SCORE.increase();
            if (SCORE.isGameClear(BRICKS)) {
              GAME_STATE.setGameClear();
            }
          }
        }
      }
    }
  }
}