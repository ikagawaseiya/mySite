export const TITLE_SCREEN = {
  show() {
    const screen = document.getElementById("titleScreen");
    if (screen) screen.style.display = "flex"; // CSSに合わせて block や flex に変更
  },
  hide() {
    const screen = document.getElementById("titleScreen");
    if (screen) screen.style.display = "none";
  }
};