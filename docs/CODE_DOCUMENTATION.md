# Pawsitive Placements - Code Documentation Standards

**Author:** Lindsey D. Stead  
**Date:** November 7, 2025  
**Version:** 1.0

This document outlines the code documentation standards and practices used throughout the Pawsitive Placements application.

## 📝 File Header Standards

All PHP files must include a professional file header with the following format:

```php
<?php
/**
 * Pawsitive Placements
 * 
 * @file       path/to/file.php
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Brief but comprehensive description of the file's purpose,
 *              main functionality, and any important notes about usage.
 */
```

### Header Components

- **@file**: Relative path from project root
- **@author**: Always "Lindsey D. Stead"
- **@date**: Date of creation or last major update
- **@description**: Clear description of file purpose and functionality

## 📚 Function Documentation

All functions must include PHPDoc comments:

```php
/**
 * Brief description of what the function does
 * 
 * @param type $paramName Description of the parameter
 * @param type|null $optionalParam Description (use |null for optional params)
 * @return type Description of return value
 * @throws ExceptionType When and why this exception is thrown
 * 
 * @example
 * $result = function_name($param1, $param2);
 */
function function_name($paramName, $optionalParam = null): returnType {
    // Function implementation
}
```

### Function Documentation Guidelines

- **Brief Description**: One-line summary of function purpose
- **Detailed Description**: (Optional) Multi-line explanation for complex functions
- **@param**: Document all parameters with types and descriptions
- **@return**: Document return type and what the value represents
- **@throws**: Document any exceptions that may be thrown
- **@example**: (Optional) Provide usage examples for complex functions

## 🔒 Security Documentation

Security-sensitive functions should include security notes:

```php
/**
 * Validates user login credentials
 * 
 * Uses password_verify() for timing-attack safe password comparison.
 * Implements account status checking (active/suspended/banned).
 * 
 * @param string $username User's username
 * @param string $password Plain text password
 * @return array|null User data array on success, null on failure
 * 
 * @security
 * - Passwords are never logged or exposed
 * - Failed login attempts may be rate-limited
 * - Account status is checked before authentication
 */
```

## 📊 Database Function Documentation

Database functions should document:

```php
/**
 * Retrieves all pets with optional filtering
 * 
 * Only returns pets with status='approved' for public listings.
 * Uses prepared statements to prevent SQL injection.
 * Supports pagination for large result sets.
 * 
 * @param string|null $search Search term for pet name or description
 * @param string|null $city Filter by city name
 * @param string|null $pet_type Filter by pet type
 * @param int $limit Maximum number of results (default: 12)
 * @param int $offset Offset for pagination (default: 0)
 * @return array Array of pet records with image paths
 * 
 * @security Uses PDO prepared statements
 * @performance Results are limited and paginated
 */
```

## 🎨 CSS Documentation

CSS files should include header comments:

```css
/**
 * Pawsitive Placements
 * 
 * @file       styles/main.css
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Main stylesheet for the application. Includes custom styles,
 *              Bootstrap overrides, form styling, and responsive design rules.
 */

/* Section: Global Styles */
/* Description of what this section does */
```

## 📜 JavaScript Documentation

JavaScript files should include JSDoc comments:

```javascript
/**
 * Pawsitive Placements
 * 
 * @file       js/ajax-handler.js
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Centralized AJAX utility functions for form submissions.
 *              Provides consistent error handling, loading states, and user feedback.
 */

/**
 * Submits a form via AJAX
 * @param {string} formSelector - CSS selector for the form element
 * @param {string} apiEndpoint - API endpoint URL
 * @param {Object} options - Configuration options
 * @param {Function} options.onSuccess - Success callback function
 * @param {Function} options.onError - Error callback function
 * @returns {void}
 */
```

## 📄 SQL Documentation

SQL files should include header comments:

```sql
-- ============================================================================
-- Pawsitive Placements - Complete Database Schema
-- 
-- @file       database/schema.sql
-- @author     Lindsey D. Stead
-- @date       November 7, 2025
-- @description Complete database schema for Pawsitive Placements application.
--              Includes all tables, indexes, foreign keys, and seed data.
-- ============================================================================
```

## ✅ Code Comment Best Practices

### Inline Comments
- Use comments to explain **why**, not **what**
- Comment complex logic or business rules
- Document workarounds or non-obvious solutions
- Keep comments up-to-date with code changes

### Example of Good Comments:

```php
// Check account status before authentication to prevent banned users from logging in
if ($user_id && !is_user_account_active($user_id)) {
    // Account is suspended or banned - deny access
    return null;
}

// Use prepared statement to prevent SQL injection
$statement = $db->prepare($query);
$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
```

### Example of Bad Comments:

```php
// Set user_id variable
$user_id = $_SESSION['user_id'];

// Loop through users
foreach ($users as $user) {
    // Do something
}
```

## 📋 Documentation Checklist

Before committing code, ensure:

- [ ] All PHP files have proper file headers
- [ ] All functions have PHPDoc comments
- [ ] Complex logic has inline comments
- [ ] Security-sensitive code is documented
- [ ] Database queries are documented
- [ ] API endpoints are documented
- [ ] CSS sections are organized with comments
- [ ] JavaScript functions have JSDoc comments

## 🎯 Professional Standards

This codebase follows professional development standards:

- **Consistent Naming**: camelCase for variables, snake_case for database, descriptive names
- **Type Hints**: PHP 8+ type hints on all function parameters and returns
- **Error Handling**: Try-catch blocks for database operations, proper error logging
- **Security First**: All user input validated, all output escaped, prepared statements used
- **Code Organization**: MVC pattern, separation of concerns, reusable components
- **Documentation**: Comprehensive comments, clear function names, well-structured code

---

**Documentation maintained by:** Lindsey D. Stead  
**Last Updated:** November 7, 2025

