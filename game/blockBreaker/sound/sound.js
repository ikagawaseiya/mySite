let audioContext = null;
/**
 * オーディオバッファー
 * 連続で音を鳴らせるようにするため、音声ファイルを事前にデコードして保持する
 */
const buffer = {};

// 音声ファイルのパス
const SOUND_PATHS = {
  ballReflection: '/game/blockBreaker/sound/se/ballReflection.mp3',
  blockBreak: '/game/blockBreaker/sound/se/blockBreak.mp3',
  lifeLose: '/game/blockBreaker/sound/se/lifeLose.mp3',
  gameClear: '/game/blockBreaker/sound/se/gameClear.mp3',
  gameOver: '/game/blockBreaker/sound/se/gameOver.mp3',
  gameStart: '/game/blockBreaker/sound/se/gameStart.mp3'
};

/**
 * 音声ファイルを事前ロードしてデコードする
 * 
 * @returns {Promise<void>}
 */
export async function setupSound() {
  if (!audioContext) {
    audioContext = new (window.AudioContext || window.webkitAudioContext)();
  }
  const promises = Object.entries(SOUND_PATHS).map(async ([key, path]) => {
    try {
      const response = await fetch(path);
      const arrayBuffer = await response.arrayBuffer();
      buffer[key] = await audioContext.decodeAudioData(arrayBuffer);
    } catch (error) {
      console.error(`Failed to load sound: ${path}`, error);
    }
  });
  await Promise.all(promises);
}

/**
 * 内部用の音再生ヘルパー関数
 * 音再生を行う
 */
function playSound(bufferKey) {
  if (!audioContext || !buffer[bufferKey]) return;
  const source = audioContext.createBufferSource();
  source.buffer = buffer[bufferKey];
  source.connect(audioContext.destination);
  source.start(0);
}

/**
 * サウンドクラス
 * 音に関する処理を持つ  
 */
export class Sound {
  /**ボールの反射音 */
  ballReflection() {
    playSound('ballReflection');
  }

  /**レンガの破壊音 */
  blockBreak() {
    playSound('blockBreak');
  }

  /**ライフ減少 */
  lifeLose() {
    playSound('lifeLose');
  }

  /**ゲームクリア */
  gameClear() {
    playSound('gameClear');
  }

  /**ゲームオーバー */
  gameOver() {
    playSound('gameOver');
  }

  /**ゲームスタート*/
  gameStart() {
    playSound('gameStart');
  }
}