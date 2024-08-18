<?php


/**
 * Set a cookie.
 *
 * @param string $name The name of the cookie.
 * @param string $value The value of the cookie.
 * @param int $expire The expiration time as a timestamp.
 * @param string $path The path on the server where the cookie will be available.
 * @param string $domain The domain that the cookie is available to.
 * @param bool $secure Indicates whether the cookie should be sent over secure connections.
 * @param bool $httponly Indicates whether the cookie is accessible only through the HTTP protocol.
 */
function setCookieValue($name, $value, $expire = 3600, $path = "/", $domain = "", $secure = false, $httponly = true) {
    setcookie($name, $value, [
        'expires' => time() + $expire,
        'path' => $path,
        'domain' => $domain,
        'secure' => $secure,
        'httponly' => $httponly,
        'samesite' => 'Lax' 
    ]);
}

/**
 * Get a cookie value.
 *
 * @param string $name The name of the cookie.
 * @return mixed The value of the cookie or null if not set.
 */
function getCookieValue($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

/**
 * Delete a cookie.
 *
 * @param string $name The name of the cookie to delete.
 * @param string $path The path on the server where the cookie was available.
 * @param string $domain The domain that the cookie was available to.
 */
function deleteCookie($name, $path = "/", $domain = "") {
    setcookie($name, '', [
        'expires' => time() - 3600,
        'path' => $path,
        'domain' => $domain,
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}
?>
