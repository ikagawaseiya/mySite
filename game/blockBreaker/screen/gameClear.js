/**
 * ゲームクリアスクリーン
 * ゲームクリアの画面を描画する処理を持つ
 */
export const GAME_CLEAR_SCREEN = {
  //クリア画面の描画
  draw(CTX, CANVAS, clearTime) {
    CTX.fillStyle = "rgba(0, 0, 0, 0.6)";
    CTX.fillRect(0, 0, CANVAS.width, CANVAS.height);

    CTX.font = "bold 48px Arial";
    CTX.fillStyle = "yellow";
    CTX.textAlign = "center";
    CTX.fillText("GAME CLEAR!", CANVAS.width / 2, CANVAS.height / 2 - 10);

    const minute = clearTime[0];
    const second = clearTime[1];
    CTX.font = "32px Impact";
    CTX.fillStyle = "white";
    CTX.fillText(`CLEAR TIME ${minute}:${second}`, CANVAS.width / 2, CANVAS.height / 2 + 40);
  }
}