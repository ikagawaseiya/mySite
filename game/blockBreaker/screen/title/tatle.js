
/**
 * タイトル画面のjs
 * タイトル画面を表示・非表示にする処理を持つ
 */
export const TITLE_SCREEN = {
  show() {
    const screen = document.getElementById("title-Screen");
    if (screen) screen.style.display = "flex";
  },
  hide() {
    const screen = document.getElementById("title-Screen");
    if (screen) screen.style.display = "none";
  }
};