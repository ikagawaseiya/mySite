const RADIUS = 6;
const START_DX_SPEED = 1;
const START_DY_SPEED = 1;
const DEFAULT_COLOR = 'skyblue';
const CHANGED_COLOR = 'white';
const BALL_MAX_SPEED_LIMIT = 3;

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
    this.ballColorStyle = DEFAULT_COLOR;
  }

  /**
   * ボールを描画する
   * @param {*} CTX 描画するコンテキスト
   */
  draw(CTX) {
    CTX.beginPath();
    CTX.arc(this.x, this.y, RADIUS, 0, Math.PI * 2);
    CTX.fillStyle = this.ballColorStyle;
    CTX.fill();
    CTX.closePath();
  }

  /**
   * ボールを移動する
   * 
   * 移動の後、移動によって起こるアクションをチェックする
   */
  move(PADDLE, BLOCKS, SCORE, LIVES, GAME_STATE, SOUND) {
    this.x += this.dx;
    this.y += this.dy;

    this.checkReflectionForCanvasSide(SOUND);
    this.checkReflectionForCanvasTop(SOUND);
    this.checkReflectionForCanvasBottom(PADDLE, LIVES, GAME_STATE, SOUND);
    this.checkBlocksCollision(BLOCKS, SCORE, GAME_STATE, SOUND);
  }

  /**
   * ボールの色を変更する
   * 水色と白で交互とする
   */
  changeBallColor() {
    if (this.ballColorStyle == CHANGED_COLOR) {
      this.ballColorStyle = DEFAULT_COLOR;
    } else {
      this.ballColorStyle = CHANGED_COLOR;
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
  checkReflectionForCanvasSide(SOUND) {
    if (this.x + this.dx > this.canvas.width - RADIUS || this.x + this.dx < RADIUS) {
      SOUND.ballReflection();
      this.dx = -this.dx;
      this.changeBallColor()
    }
  }

  /*
  *キャンバス頂点であるかを判定し、
  *そうである場合、dyを反転させることで反射する
  *その後、ボールの色を変更する
  */
  checkReflectionForCanvasTop(SOUND) {
    if (this.isCanvasTop()) {
      SOUND.ballReflection();
      this.dy = -this.dy;
      this.changeBallColor();
    }
  }

  //キャンバスの最上部に触れたかを返す
  isCanvasTop() {
    return this.y + this.dy < RADIUS;
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
  checkReflectionForCanvasBottom(PADDLE, LIVES, GAME_STATE, SOUND) {
    const PADDLE_Y = this.canvas.height - RADIUS - PADDLE.Height;
    if (this.y + this.dy > PADDLE_Y) {
      if (this.x > PADDLE.paddleX && this.x < PADDLE.paddleX + PADDLE.Width) {
        SOUND.ballReflection();
        this.y = PADDLE_Y;
        this.dy = -this.dy;
        this.changeSpeedForReflection();
        this.changeBallColor();
      }
      else if (this.y + this.dy > this.canvas.height - RADIUS + RADIUS) {
        LIVES.lose();
        if (!LIVES.isGameOver()) {
          SOUND.lifeLose();
        }
        if (LIVES.isGameOver()) {
          SOUND.gameOver();
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
  checkBlocksCollision(BLOCKS, SCORE, GAME_STATE, SOUND) {
    for (var c = 0; c < BLOCKS.blockColumnCount; c++) {
      for (var r = 0; r < BLOCKS.blockRowCount; r++) {
        var block = BLOCKS.blocks[c][r];
        //衝突した場合の処理
        if (block.status === BLOCKS.blockStartHp) {
          if (this.isBrickCollision(block)) {
            if (!SCORE.isGameClear(BLOCKS)) {
              SOUND.blockBreak();
            }
            this.dy = -this.dy;
            block.status = BLOCKS.blockDestroyHp;
            this.changeBallColor();
            SCORE.increase();
            if (SCORE.isGameClear(BLOCKS)) {
              SOUND.gameClear();
              GAME_STATE.setGameClear();
            }
          }
        }
      }
    }
  }

  /**
   * レンガと衝突したかを判定する
   * それを返す
   * 
   * 以下のすべてを満たした場合、レンガとの衝突とする
   * ・レンガの左端より右側
   * ・レンガの右端より左側
   * ・レンガの底より上側
   * ・レンガの頂点より下側
   * 
   * @param {BLOCKS} block レンガ
   * @returns レンガと 衝突した / 衝突していない
   */
  isBrickCollision(block) {
    const HITBOX_SHRINK_ADJUSTMENT_NUM = 2;
    return this.x + RADIUS - HITBOX_SHRINK_ADJUSTMENT_NUM > block.x &&
      this.x - RADIUS + HITBOX_SHRINK_ADJUSTMENT_NUM < block.x + block.width &&
      this.y + RADIUS - HITBOX_SHRINK_ADJUSTMENT_NUM > block.y &&
      this.y - RADIUS + HITBOX_SHRINK_ADJUSTMENT_NUM < block.y + block.height;
  }
}