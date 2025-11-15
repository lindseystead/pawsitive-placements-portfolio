<?php
/**
 * Pawsitive Placements
 * 
 * @file       api/newsletter.php
 * @author     Lindsey D. Stead
 * @date       November 2025
 * @description API endpoint for newsletter subscription. Returns JSON responses
 *              for AJAX requests. Handles email validation and links to users.
 */

header('Content-Type: application/json');

require_once('../util/session.php');
require_once('../util/csrf.php');
require_once('../model/database.php');
require_once('../model/users_db.php');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Method not allowed'
    ]);
    exit;
}

// Validate CSRF token
require_valid_csrf();

// Retrieve and validate email
$email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));

// Validate email
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'error' => 'Please enter a valid email address.'
    ]);
    exit;
}

// Get user_id if user is logged in
$user_id = null;
$name = null;
if (isset($_SESSION['is_valid_user']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Get user's name if available
    $user = get_user_by_id($user_id);
    if ($user && isset($user['name'])) {
        $name = $user['name'];
    }
}

// Get source (default to footer_form)
$source = filter_input(INPUT_POST, 'source', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: 'footer_form';

// Add newsletter subscription
$result = add_newsletter_subscription($email, $user_id, $name, $source);

if ($result['success']) {
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => $result['message'],
        'action' => $result['action']
    ]);
} else {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $result['message']
    ]);
}

