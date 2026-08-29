/**
 * ゲームクリアスクリーン
 * ゲームクリアの画面を描画する処理を持つ
 */
export const GAME_CLEAR_SCREEN = {
  //クリア画面の描画
  draw(CTX, CANVAS) {
    CTX.fillStyle = "rgba(0, 0, 0, 0.6)";
    CTX.fillRect(0, 0, CANVAS.width, CANVAS.height);

    CTX.font = "bold 32px Arial";
    CTX.fillStyle = "#FFD700";
    CTX.textAlign = "center";
    CTX.fillText("GAME CLEAR!", CANVAS.width / 2, CANVAS.height / 2 - 10);

    CTX.font = "16px Arial";
    CTX.fillStyle = "#FFF";
    CTX.fillText("クリックorタッチでタイトルへ戻る", CANVAS.width / 2, CANVAS.height / 2 + 40);
  }
}