<?php
/**
 * プロフィールに関する情報を持つクラス
 */
class Profile {
  /**
   * 名前を返す
   * 
   * @return array 名前:五十川誠也
   */
    public function getName() {
        // 本来はここにDB接続処理などを書きます
        return [
            'name' => "五十川 誠也",
        ];
    }
}