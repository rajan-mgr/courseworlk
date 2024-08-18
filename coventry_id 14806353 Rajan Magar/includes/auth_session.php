<?php

include 'session.php'; 

/**
 * Check if the user is logged in.
 
 * @return bool True if logged in, false otherwise.
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']); 
}

/**
 * Log in the user by setting session variables.
 *
 * @param int $userId The user's ID.
 */
function loginUser($userId) {
    setSessionValue('user_id', $userId); 
}

/**
 * Log out the user by destroying the session.
 */
function logoutUser() {
    destroySession(); 
}
?>
