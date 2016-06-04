<?php

// Cross-site request forgery token generation.
if (isset($_SESSION['csrf'])) {
    $last_csrf = $_SESSION['csrf'];
    unset($_SESSION['csrf']);
}
$_SESSION['csrf'] = uniqid(md5(microtime(true)) . '.', true);

function csrfValid()
{
    global $last_csrf;
    $form_csrf = filter_input(INPUT_POST, 'csrf', FILTER_UNSAFE_RAW);
    return ($last_csrf === $form_csrf);
}