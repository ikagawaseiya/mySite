<?php

/**
 *エラー表示の環境設定ファイル
 *エラー表示を無効化し、logファイルに出力する設定を行う
 */
@ini_set('display_errors', 'Off');
@ini_set('log_errors', 'On');
@error_reporting(E_ALL);
@ini_set('error_log', __DIR__ . '/error.log');
