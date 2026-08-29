/**
 * タイトルスクリーン
 * タイトル描画の処理を持つ
 */
export const TITLE_SCREEN = {
  //タイトル画面の描画
  draw(CTX, CANVAS) {
    CTX.fillStyle = "red";
    CTX.fillRect(0, 0, CANVAS.width, CANVAS.height);

    CTX.font = "bold 24px Arial";
    CTX.fillStyle = "white";
    CTX.textAlign = "center";
    CTX.fillText("BLOCK BREAKER", CANVAS.width / 2, CANVAS.height / 2 - 20);

    CTX.font = "16px Arial";
    CTX.fillStyle = "white";
    CTX.fillText("クリックorタッチでスタート", CANVAS.width / 2, CANVAS.height / 2 + 30);
  }
}