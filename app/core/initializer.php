<?php
spl_autoload_register(static function ($item) {
    if (file_exists('App\\Components\\' . ucfirst($item) . '.php')) {
        include_once 'App\\Components\\' . ucfirst($item) . '.php';
    } elseif (file_exists("App\\Core\\$item.php")) {
        include_once "App\\Core\\$item.php";
    } elseif (file_exists("App\\Models\\$item.php")) {
        include_once "App\\Models\\$item.php";
    } else {
        Log::writeLog("Файл $item не был найден.");
    }
});
session_start();
(new Router())->init();
session_write_close();

