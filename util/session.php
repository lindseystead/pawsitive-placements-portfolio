<?php
/**
 * Pawsitive Placements
 * 
 * @file       util/session.php
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Manages secure session initialization with HttpOnly cookies.
 */

/**
 * Starts a secure session with HttpOnly cookies and proper security settings
 */
function start_secure_session(): void {
    $isHttps = (
        (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
        (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
        (isset($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on')
    );
    
    $cookieParams = [
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax',
    ];
    
    if (PHP_SESSION_ACTIVE !== session_status()) {
        session_set_cookie_params($cookieParams);
        session_start();
        
        if (!isset($_SESSION['created'])) {
            $_SESSION['created'] = time();
        } elseif (time() - $_SESSION['created'] > 1800) {
            session_regenerate_id(true);
            $_SESSION['created'] = time();
        }
    }
}

start_secure_session();


