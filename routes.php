<?php
$routes = [
    // === VIEWS (Frontend Pages) ===
    '/'                     => 'views/home.php',
    '/home'                 =>'views/home.php',
    '/dashboard' => 'views/dashboard.php',
    '/cart'                 => 'views/cart.php',
    '/billing'              => 'views/billing.php',
    '/forgot-password'   => 'views/forgot-password.php',
    '/reset-password'    => 'views/auth/reset-password.php',  // expects ?token= in query string
    '/verify-otp'        => 'controllers/verify-otp.php',
    '/reset-message'     => 'views/reset-message.php',

    // === CONTROLLERS (Logic Handlers) ===
    '/add-product'          => 'controllers/add-product.php',
    '/add-to-cart'          => 'controllers/Add-to-cart.php',
    '/authenticate'         => 'controllers/authenticate.php',
    '/checkout'             => 'controllers/checkout.php',
    '/fetch-stats'          => 'views/fetch_stats.php',
    '/insert-user'          => 'controllers/insert_user.php',

    // === DATA UPLOADS ===
    '/upload-products'      => 'data-upload/upload_products.php',
    '/upload-csv'           => 'data-upload/upload_csv.php',

    // === Auth ===
    '/login'                => 'views/login.php',
    '/register'             => 'views/register.php',

    // === Error or fallback ===
    '/404'                  => 'views/404.php',
    '/about'                => 'views/about.php',
    '/logout' => 'controllers/logout.php',
    

];
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (array_key_exists($request, $routes)) {
    require $routes[$request];
    exit;
} else {
    // Fallback to 404
    require 'views/404.php';
    exit;
}
