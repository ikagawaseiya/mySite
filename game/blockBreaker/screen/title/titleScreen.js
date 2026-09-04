const TITLE = document.getElementById("title-screen");

export const TITLE_SCREEN = {
  show() {
    if (TITLE) TITLE.style.display = "flex";
  },
  hide() {
    if (TITLE) TITLE.style.display = "none";
  }
};

TITLE?.getElementById('top-page-button')?.addEventListener("click", () => {
  location = "/";
});