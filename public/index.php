<?php
session_start();

require_once __DIR__ . '/../routes.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Handle homepage
if ($uri === '') {
    $uri = 'home';
}

if (array_key_exists("/" . $uri, $routes)) {
    require_once __DIR__ . '/../' . $routes["/" . $uri];
} else {
    require_once __DIR__ . '/../views/404.php';
    echo "URI = " . $uri; exit;    
}
