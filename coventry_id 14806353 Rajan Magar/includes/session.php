<?php

session_start(); 

/**
 * Set a session variable.
 *
 * @param string $key The key of the session variable.
 * @param mixed $value The value to set.
 */
function setSessionValue($key, $value) {
    $_SESSION[$key] = $value;
}

/**
 * Get a session variable.
 *
 * @param string $key The key of the session variable.
 * @return mixed The value of the session variable or null if not set.
 */
function getSessionValue($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}

/**
 * Destroy the session.
 */
function destroySession() {
    session_unset(); 
    session_destroy(); 
}
?>
