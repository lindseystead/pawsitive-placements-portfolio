<?php
/**
 * Pawsitive Placements
 * 
 * @file       model/users_db_sample.php
 * @author     Lindsey D. Stead
 * @date       November 2025
 * @description Sample database model functions demonstrating PDO usage, prepared statements,
 *              and security best practices. This is a representative sample - full implementation
 *              is proprietary and available for review upon request.
 * 
 * NOTE: This is a PORTFOLIO SAMPLE. The full model contains 20+ functions.
 * Full codebase (71 files, 14,110+ lines) available for review upon request.
 */

require_once __DIR__ . '/../database.php'; // Database connection (excluded from portfolio)

/**
 * Authenticates a user by username and password
 * Demonstrates: PDO prepared statements, password verification, security best practices
 * 
 * @param string $username The username to check
 * @param string $password The plain text password to verify
 * @return array|null User data if credentials are valid, null otherwise
 */
function get_user_by_username_password(string $username, string $password): ?array {
    global $db;
    
    // PDO prepared statement prevents SQL injection
    $query = 'SELECT * FROM users WHERE username = :username LIMIT 1';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    
    // Verify password using password_verify (bcrypt)
    if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
        // Check account status (active/suspended/banned)
        $user_id = $user['user_id'] ?? null;
        if ($user_id && !is_user_account_active($user_id)) {
            return null; // Account suspended/banned
        }
        return $user;
    }
    return null;
}

/**
 * Creates a new user account
 * Demonstrates: Password hashing, input validation, transaction safety
 * 
 * @param string $name User's full name
 * @param string $username Unique username
 * @param string $email Unique email address
 * @param string|null $phone Phone number (optional)
 * @param string $password Plain text password (will be hashed)
 * @return bool True if user was created successfully
 */
function add_user(string $name, string $username, string $email, ?string $phone, string $password): bool {
    global $db;
    
    // Input validation
    if (empty(trim($name)) || empty(trim($username)) || empty(trim($email)) || empty(trim($password))) {
        error_log("add_user: Missing required fields");
        return false;
    }
    
    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error_log("add_user: Invalid email format");
        return false;
    }
    
    try {
        // PDO prepared statement with parameter binding
        $query = 'INSERT INTO users (name, username, email, phone, password) 
                  VALUES (:name, :username, :email, :phone, :password)';
        $statement = $db->prepare($query);
        
        // Hash password using bcrypt (PASSWORD_DEFAULT uses bcrypt)
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        if ($hashed === false) {
            error_log("add_user: Password hashing failed");
            return false;
        }
        
        // Bind values with proper types
        $statement->bindValue(':name', trim($name), PDO::PARAM_STR);
        $statement->bindValue(':username', trim($username), PDO::PARAM_STR);
        $statement->bindValue(':email', trim(strtolower($email)), PDO::PARAM_STR);
        $statement->bindValue(':phone', $phone ? trim($phone) : null, PDO::PARAM_STR);
        $statement->bindValue(':password', $hashed, PDO::PARAM_STR);
        
        $result = $statement->execute();
        $new_user_id = $db->lastInsertId();
        $statement->closeCursor();
        
        // Auto-link newsletter subscriptions if email exists
        if ($result && $new_user_id) {
            try {
                $link_stmt = $db->prepare("UPDATE newsletter_subscriptions 
                                          SET user_id = :user_id, name = :name, updated_at = CURRENT_TIMESTAMP
                                          WHERE email = :email AND (user_id IS NULL OR user_id = 0)");
                $link_stmt->bindValue(':user_id', $new_user_id, PDO::PARAM_INT);
                $link_stmt->bindValue(':name', trim($name), PDO::PARAM_STR);
                $link_stmt->bindValue(':email', trim(strtolower($email)), PDO::PARAM_STR);
                $link_stmt->execute();
                $link_stmt->closeCursor();
            } catch (PDOException $e) {
                error_log("Error linking newsletter subscription: " . $e->getMessage());
            }
        }
        
        return $result;
    } catch (PDOException $e) {
        error_log("Error adding user: " . $e->getMessage());
        return false;
    }
}

/**
 * Gets user information by user ID
 * Demonstrates: Type hints, error handling, PDO fetch patterns
 * 
 * @param int $user_id The user's ID
 * @return array|null User data if found, null otherwise
 */
function get_user_by_id(int $user_id): ?array {
    global $db;
    
    if ($user_id <= 0) {
        return null;
    }
    
    try {
        $query = 'SELECT * FROM users WHERE user_id = :user_id LIMIT 1';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        
        return $user ?: null;
    } catch (PDOException $e) {
        error_log("Error fetching user by ID: " . $e->getMessage());
        return null;
    }
}

/**
 * Checks if a user account is active (not suspended or banned)
 * Demonstrates: Account status management, security checks
 * 
 * @param int $user_id The user's ID
 * @return bool True if account is active
 */
function is_user_account_active(int $user_id): bool {
    global $db;
    
    try {
        $query = 'SELECT account_status FROM users WHERE user_id = :user_id LIMIT 1';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        
        return ($result && ($result['account_status'] ?? 'active') === 'active');
    } catch (PDOException $e) {
        error_log("Error checking account status: " . $e->getMessage());
        return false;
    }
}

/**
 * NOTE: This file contains representative samples only.
 * 
 * The full model/users_db.php contains 20+ additional functions including:
 * - Password reset token management
 * - Email verification
 * - Profile updates
 * - Address management
 * - Newsletter subscription management
 * - Contact form handling
 * - And more...
 * 
 * Full codebase available for portfolio review upon request.
 * Contact: info@lifesavertech.ca
 */

