/**難易度の種類 */
const DIFFICULTY_TYPE = Object.freeze({
  NORMAL: 'NORMAL',
  HARD: 'HARD',
});

export class Difficulty {
  /**
   * コンストラクタ
   * 初期設定はNORMALとする
   */
  constructor() {
    const INITIAL_DEFFICUTY = DIFFICULTY_TYPE.NORMAL;
    this.type = INITIAL_DEFFICUTY;
    this.types = Object.keys(DIFFICULTY_TYPE);
  }

  /**難易度をひとつ下げる */
  setLowOneLevel() {
    let currentDifficultyIndex = this.types.indexOf(this.type);
    let nextDifficultyIndex = currentDifficultyIndex - 1;
    if (nextDifficultyIndex < 0) {
      nextDifficultyIndex = this.types.length - 1;
    }
    this.type = this.types[nextDifficultyIndex];
  }

  /**難易度をひとつ上げる */
  setHighOneLevel() {
    let currentDifficultyIndex = this.types.indexOf(this.type);
    let nextDifficultyIndex = currentDifficultyIndex + 1;
    if (nextDifficultyIndex > this.types.length - 1) {
      nextDifficultyIndex = 0;
    }
    this.type = this.types[nextDifficultyIndex];
  }


  /**難易度がNORMALであるかを返す */
  isNormal() {
    return this.type === DIFFICULTY_TYPE.NORMAL;
  }

  /**難易度がHARDであるかを返す */
  isHard() {
    return this.type === DIFFICULTY_TYPE.HARD;
  }
}