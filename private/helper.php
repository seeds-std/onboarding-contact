<?php
/* --------------------
 * ヘルパー関数
 * -------------------- */

if (!function_exists('str_starts_with')) {
    /**
     * haystack が needle で開始しているかを調べる (※mb非対応)
     * @param  string  $haystack 文字列
     * @param  string  $needle 検索文字列
     * @return bool
     */
    function str_starts_with(string $haystack, string $needle): bool {
        return strncmp($haystack, $needle, strlen($needle)) === 0;
    }
}

if (!function_exists('str_remove_prefix')) {
    /**
     * haystack が needle で開始している場合、その文字を削除する (※mb非対応)
     * @param string $haystack 文字列
     * @param string $needle 検索文字列
     * @return string
     */
    function str_remove_prefix(string $haystack, string $needle): string {
        if (str_starts_with($haystack, $needle)) {
            $haystack = substr($haystack, strlen($needle));
        }
        return $haystack;
    }
}

if (!function_exists('redirect')) {
    /**
     * リダイレクトを行う
     * @param string $location リダイレクト先
     * @param int $status ステータスコード
     */
    function redirect(string $location, int $status = 302) {
        $schema = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $location = str_remove_prefix($location, '/');
        $url = $schema . '://' . $host . '/' . $location;

        if (!headers_sent()) {
            header('Location: ' . $url, true, $status);
        }

        echo sprintf('<div>リダイレクト先: <a href="%1$s">%1$s</a></div>', htmlspecialchars($url, ENT_QUOTES, 'UTF-8'));
        exit;
    }
}

if (!function_exists('dd')) {
    /**
     * 値を出力して直ちにプログラムを終了させる
     * @param  mixed ...$vars 出力する値
     */
    function dd(...$vars) {
        echo '<pre>';
        var_dump(...$vars);
        echo '</pre>';
        exit;
    }
}
