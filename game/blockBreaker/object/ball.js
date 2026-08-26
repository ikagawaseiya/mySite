//ボールの各種設定
/*半径*/
export const ballRadius = 10;

export function ball(canvas) {
  const startDxSpeed = 1;
  const startDySpeed = 1;
  const startBallColorNumber = 240;
  return {
    /*初期位置*/
    x: canvas.width / 2,
    y: canvas.height / 2,
    /*初期速度*/
    dx: startDxSpeed,
    dy: startDySpeed,
    /*初期色*/
    ballColorStyle: `hsl(${startBallColorNumber}, 70%, 60%)`
  };
}

//ボールの描画
export function drawBall(/*引数を入れる*/) {
  ctx.beginPath();
  ctx.arc(x, y, ballRadius, 0, Math.PI * 2);
  ctx.fillStyle = ballColorStyle;
  ctx.fill();
  ctx.closePath();
}