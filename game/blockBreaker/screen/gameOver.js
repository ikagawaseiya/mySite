/**
 * ゲームオーバースクリーン
 * ゲームオーバー画面を描画する処理を持つ
 */
export const GAME_OVER_SCREEN = {
  //ゲームオーバー画面の描画
  draw(CTX, CANVAS) {
    CTX.fillStyle = "rgba(0, 0, 0, 0.6)";
    CTX.fillRect(0, 0, CANVAS.width, CANVAS.height);

    CTX.font = "bold 32px Arial";
    CTX.fillStyle = "#FF0000";
    CTX.textAlign = "center";
    CTX.fillText("GAME OVER", CANVAS.width / 2, CANVAS.height / 2 - 10);

    CTX.font = "16px Arial";
    CTX.fillStyle = "#FFF";
    CTX.fillText("クリックorタッチでタイトルへ戻る", CANVAS.width / 2, CANVAS.height / 2 + 40);
  }
}