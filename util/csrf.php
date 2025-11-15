<?php
/**
 * Pawsitive Placements
 * 
 * @file       util/csrf.php
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description CSRF protection functions. Generates and validates tokens for forms.
 */

require_once __DIR__ . '/session.php';

/**
 * Gets or generates a CSRF token for the current session
 * 
 * @return string CSRF token
 */
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validates a CSRF token using hash_equals to prevent timing attacks
 * 
 * @param string|null $token Token to validate
 * @return bool True if valid
 */
function is_valid_csrf(?string $token): bool {
    return is_string($token) 
        && isset($_SESSION['csrf_token']) 
        && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Validates CSRF token on POST requests, exits with 400 if invalid
 */
function require_valid_csrf(): void {
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    
    if (strtoupper($method) === 'POST') {
        $token = filter_input(INPUT_POST, 'csrf_token');
        if (!is_valid_csrf($token)) {
            http_response_code(400);
            echo 'Invalid CSRF token.';
            exit();
        }
    }
}

/**
 * Generates a hidden input field with the CSRF token
 * 
 * @return string HTML input field with CSRF token
 */
function csrf_token_field(): string {
    $token = csrf_token();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
}

