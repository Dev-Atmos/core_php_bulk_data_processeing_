<?php

if (!function_exists('load_view')) {
    function load_view(string $viewPath, array $data = [], bool $cache = false): void
    {
        $viewFile = VIEW_PATH . str_replace('.', '/', $viewPath) . '.php';
        if (!is_dir(CACHE_PATH)) {
            mkdir(CACHE_PATH, 0755, true);
        }
        if (!is_dir(VIEW_PATH)) {
            mkdir(VIEW_PATH, 0755, true);
        }
        if (!is_dir(ASSET_PATH)) {
            mkdir(ASSET_PATH, 0755, true);
        }   

        if(file_exists($viewFile) && !is_readable($viewFile)) {
            echo "<h4>⚠ View file is not readable: $viewFile</h4>";
            return;
        }
        $cacheFile = CACHE_PATH . md5($viewPath . serialize(array_keys($data))) . '.html';

        if ($cache && file_exists($cacheFile)) {
            if (filemtime($cacheFile) + CACHE_LIFETIME > time()) {
                readfile($cacheFile);
                return;
            }
        }

        if (!file_exists($viewFile)) {
            echo "<h4>⚠ View not found: $viewFile</h4>";
            return;
        }

        extract($data);
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        if ($cache) {
            file_put_contents($cacheFile, $content);
        }

        echo $content;
    }
}
