const BALL_REFRECTION = new Audio('/game/blockBreaker/sound/ballRefrection.mp3');
const BRICK_BREAK = new Audio('/game/blockBreaker/sound/brickBreak.mp3');

// 音量（0.0 〜 1.0）
BALL_REFRECTION.volume = 0.3;

export class Sound {
  ballRefrection() {
    BALL_REFRECTION.currentTime = 0;
    BALL_REFRECTION.play();
  }

  brickBreak() {
    BRICK_BREAK.currentTime = 0;
    BRICK_BREAK.play();
  }
}