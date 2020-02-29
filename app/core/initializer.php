<?php
spl_autoload_register(static function ($item) {
    if (file_exists('app/components/' . ucfirst($item) . '.php')) {
        include_once 'app/components/' . ucfirst($item) . '.php';
    } elseif (file_exists("app/core/$item.php")) {
        include_once "app/core/$item.php";
    } elseif (file_exists("app/models/$item.php")) {
        include_once "app/models/$item.php";
    } else {
        Log::writeLog("Файл $item не был найден.");
    }
});
session_start();
(new Router())->init();
session_write_close();

