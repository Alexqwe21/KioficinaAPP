<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Definir uma URL BASE
define('BASE_URL', 'http://localhost/kioficinaapp/public/');

// Definir uma API BASE
define('BASE_API', 'https://360criativo.com.br/api/');

define('BASE_FOTO', 'https://360criativo.com.br/uploads/');

// Sistema para carregamento automático 
spl_autoload_register(function ($class) {
    if (file_exists('../app/controllers/'.$class.'.php')) {
        require_once '../app/controllers/'.$class.'.php';
    }

    if (file_exists('../rotas/'.$class.'.php')) {
        require_once '../rotas/'.$class.'.php';
    }
});
