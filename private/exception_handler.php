<?php

/* --------------------------------------------------
 * 例外が発生した場合に呼び出される処理
 * 例えば、データベースに接続できなかった場合に呼び出される
 *
 * エラーの詳細をSlackに送信するような処理を書く場所
 * -------------------------------------------------- */
set_exception_handler(function (Throwable $throwable) {
    echo '<div>エラーが発生しました&nbsp;(´・ω・｀)</div><br>';
    echo '<table border="1"><tbody>';
    echo '<tr><th>&nbsp;ファイル&nbsp;</th><td>&nbsp;' . $throwable->getFile() . '&nbsp;(' . $throwable->getLine() . '行目)&nbsp;</td></tr>';
    echo '<tr><th>&nbsp;エラー内容&nbsp;</th><td>&nbsp;' . $throwable->getMessage() . '&nbsp;</td></tr>';
    echo '</tbody></table><br>';
    echo '<table style="border: solid"><tbody>';
    echo '<tr><th>StackTrace</th></tr>';
    foreach (explode("\n", $throwable->getTraceAsString()) as $trace) {
        echo '<tr><td>' . $trace . '</td></tr>';
    }
    echo '</tbody></table>';
});
