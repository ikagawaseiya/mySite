import { TITLE_SCREEN } from '/game/blockBreaker/screen/title/titleScreen.js';
import { GameState, STATE_TYPE } from '/game/blockBreaker/state/gameState.js';
/**キャンバス */
const CANVAS = document.getElementById("myCanvas");
/**描画コンテキスト */
const CTX = CANVAS.getContext("2d");
/**ゲームの状態 */
const GAME_STATE = new GameState();

TITLE_SCREEN.init({
  gameState: GAME_STATE,
  sound: SOUND,
  restartObject: restartObject,
  touchArea: TOUCH_AREA,
})