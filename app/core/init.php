<?php
// Comment out the next line when in production.
define('DEVELOPMENT', 1);

// Error reporting and buffering.
if (defined('DEVELOPMENT')) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    error_reporting(0);
    ob_start();
}

// Session.
session_name('LbSessId');
session_set_cookie_params(3 * 86400);
session_cache_limiter('nocache');
session_start();

// Cross-site request forgery token generation.
if (isset($_SESSION['csrf'])) {
    $last_csrf = $_SESSION['csrf'];
    unset($_SESSION['csrf']);
}
$_SESSION['csrf'] = uniqid(md5(microtime(true)) . '.', true);

// Convenient way to get the page's URI.
$thisPage = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);

// Function to redirect to another page.
function redirect($location)
{
    if (!defined('DEVELOPMENT')) {
        ob_end_clean();
    }
    header("Location: {$location}");
    exit();
}

// Default layout settings.
$layout = [
    'navbar' => true,
];