/**
 * ゲームオーバースクリーン
 * ゲームオーバー画面を描画する処理を持つ
 */
export const GAME_OVER_SCREEN = {
  //ゲームオーバー画面の描画
  draw(CTX, CANVAS, score, BlockTotalNum) {
    CTX.fillStyle = "rgba(0, 0, 0, 0.6)";
    CTX.fillRect(0, 0, CANVAS.width, CANVAS.height);

    CTX.font = "bold 48px Arial";
    CTX.fillStyle = "red";
    CTX.textAlign = "center";
    CTX.fillText("GAME OVER", CANVAS.width / 2, CANVAS.height / 2 - 10);

    CTX.font = "32px Impact";
    CTX.fillStyle = "white";
    CTX.fillText(`SCORE : ${score} / ${BlockTotalNum}`, CANVAS.width / 2, CANVAS.height / 2 + 40);
  }
}