-- ============================================================================
-- Pawsitive Placements - Complete Database Schema (PRODUCTION-READY)
-- 
-- @file       database/schema.sql
-- @author     Lindsey D. Stead
-- @date       November 7, 2025
-- @description Complete database schema for Pawsitive Placements application.
--              Includes all tables, indexes, foreign keys, and seed data.
--              This is the ONLY SQL file needed for production deployment.
--              Import this file via phpMyAdmin or MySQL command line.
-- ============================================================================
-- 
-- PRODUCTION DEPLOYMENT INSTRUCTIONS:
--   1. Create a new database in MySQL/MariaDB
--   2. Import this entire schema.sql file
--   3. Update .env file with your database credentials
--   4. No additional migration files are needed - this is complete!
-- 
-- This file contains the complete database schema for Pawsitive Placements.
-- It includes all tables, indexes, foreign keys, and seed data.
-- 
-- Features included:
--   - User management with email verification and account status
--   - Pet listings with vaccination status
--   - Adoption applications and messaging
--   - Community forums with posts, comments, and moderation
--   - User blocking and reporting system
--   - Rate limiting for spam prevention
--   - Contact form submissions with user tracking
--   - Profile pictures support
--   - Email queue for notifications
--   - Profile pictures
--   - Password reset functionality
--
-- Database: MariaDB/MySQL 10.4+
-- Character Set: utf8mb4 (supports emojis and international characters)
-- ============================================================================

CREATE DATABASE IF NOT EXISTS pawsitiveplacements 
    CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;

USE pawsitiveplacements;

-- ============================================================================
-- CORE TABLES
-- ============================================================================

-- Users Table
-- Stores user account information with email verification and account status
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(120) NOT NULL UNIQUE,
    phone VARCHAR(30) NULL,
    password VARCHAR(255) NOT NULL,
    email_verified BOOLEAN DEFAULT FALSE,
    email_verification_token VARCHAR(64) NULL,
    email_verification_expires DATETIME NULL,
    phone_verified BOOLEAN DEFAULT FALSE,
    account_status ENUM('active', 'suspended', 'banned') DEFAULT 'active',
    suspension_reason TEXT NULL,
    suspension_until DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username),
    INDEX idx_email_verified (email_verified),
    INDEX idx_account_status (account_status),
    INDEX idx_email_verification_token (email_verification_token),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Administrators Table
-- Stores administrator account information
CREATE TABLE IF NOT EXISTS administrators (
    adminID INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    emailAddress VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (emailAddress)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pets Table
-- Stores pet listing information including vaccination status
CREATE TABLE IF NOT EXISTS pets (
    pet_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    pet_name VARCHAR(100) NOT NULL,
    pet_type VARCHAR(50) NOT NULL,
    breed VARCHAR(100) NULL,
    age INT NULL,
    description TEXT NULL,
    city VARCHAR(100) NULL,
    fee DECIMAL(10,2) DEFAULT 0.00,
    gender VARCHAR(20) NULL,
    vaccination_status ENUM('up_to_date', 'partial', 'not_vaccinated', 'unknown') DEFAULT 'unknown',
    status ENUM('pending', 'approved', 'rejected', 'adopted', 'unavailable') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_pet_type (pet_type),
    INDEX idx_city (city),
    INDEX idx_user_id (user_id),
    INDEX idx_status (status),
    INDEX idx_vaccination_status (vaccination_status),
    INDEX idx_created_at (created_at),
    INDEX idx_fee (fee),
    CONSTRAINT fk_pets_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pet Images Table
-- Stores pet image information (supports multiple images per pet)
CREATE TABLE IF NOT EXISTS pet_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    pet_id INT NOT NULL,
    image_name VARCHAR(255) NULL,
    image_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_pet_id (pet_id),
    INDEX idx_user_id (user_id),
    CONSTRAINT fk_pet_images_pet FOREIGN KEY (pet_id) REFERENCES pets(pet_id) ON DELETE CASCADE,
    CONSTRAINT fk_pet_images_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Addresses Table
-- Stores user addresses (users can have multiple addresses)
CREATE TABLE IF NOT EXISTS addresses (
    address_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    line1 VARCHAR(255) NOT NULL,
    line2 VARCHAR(255) NULL,
    city VARCHAR(100) NOT NULL,
    province VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    phone VARCHAR(30) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    CONSTRAINT fk_addresses_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Applications Table
-- Stores adoption applications
CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pet_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    phone VARCHAR(30) NULL,
    message TEXT NOT NULL,
    application_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_pet_id (pet_id),
    INDEX idx_status (status),
    INDEX idx_application_date (application_date),
    CONSTRAINT fk_app_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT fk_app_pet FOREIGN KEY (pet_id) REFERENCES pets(pet_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Messages Table
-- Stores messages between users about pets
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pet_id INT NOT NULL,
    message TEXT NOT NULL,
    email VARCHAR(120) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_pet_id (pet_id),
    INDEX idx_created_at (created_at),
    CONSTRAINT fk_msg_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT fk_msg_pet FOREIGN KEY (pet_id) REFERENCES pets(pet_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact Form Submissions Table
-- Stores contact form submissions from both logged-in users and anonymous visitors
-- Note: user_id is nullable to support both registered users and anonymous visitors
-- This schema is production-ready and includes all necessary columns and constraints
CREATE TABLE IF NOT EXISTS contact_form_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    phone VARCHAR(30) NULL,
    comments TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at),
    CONSTRAINT fk_contact_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Newsletter Subscriptions Table
-- Stores newsletter/email list subscriptions for mass email campaigns
-- Links to users when possible, supports anonymous subscriptions
-- Handles duplicate emails intelligently (updates existing, links to users when they register)
CREATE TABLE IF NOT EXISTS newsletter_subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(120) NOT NULL UNIQUE,
    user_id INT NULL,
    name VARCHAR(100) NULL,
    subscribed BOOLEAN DEFAULT TRUE,
    source VARCHAR(50) DEFAULT 'footer_form',
    ip_address VARCHAR(45) NULL,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    unsubscribed_at TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_user_id (user_id),
    INDEX idx_subscribed (subscribed),
    INDEX idx_subscribed_at (subscribed_at),
    CONSTRAINT fk_newsletter_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Site Visit Counter Table
-- Tracks total site visits for display purposes
CREATE TABLE IF NOT EXISTS site_visits (
    id INT PRIMARY KEY DEFAULT 1,
    visit_count INT DEFAULT 0,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT chk_single_row CHECK (id = 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Initialize visit counter with 0 (only if table is empty)
INSERT IGNORE INTO site_visits (id, visit_count) VALUES (1, 0);

-- ============================================================================
-- AUTHENTICATION & SECURITY
-- ============================================================================

-- Password Reset Tokens Table
-- Stores secure tokens for password reset functionality
CREATE TABLE IF NOT EXISTS password_reset_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_type ENUM('user', 'admin') NOT NULL,
    user_id INT NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    expires_at DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_token (token),
    INDEX idx_expires (expires_at),
    INDEX idx_user_type (user_type, user_id),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Rate Limits Table
-- Tracks user actions to prevent spam and abuse
CREATE TABLE IF NOT EXISTS rate_limits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    ip_address VARCHAR(45) NOT NULL,
    action_type VARCHAR(50) NOT NULL,
    action_count INT DEFAULT 1,
    window_start TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_action (user_id, action_type, window_start),
    INDEX idx_ip_action (ip_address, action_type, window_start),
    INDEX idx_window_start (window_start),
    INDEX idx_created_at (created_at),
    CONSTRAINT fk_rate_limits_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- COMMUNITY FORUM
-- ============================================================================

-- Forum Posts Table
-- Stores community forum posts
CREATE TABLE IF NOT EXISTS forum_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    category ENUM('adoption_tips', 'rehoming_advice', 'pet_care', 'success_stories', 'community_events', 'general') DEFAULT 'general',
    province VARCHAR(100) NULL,
    city VARCHAR(100) NULL,
    status ENUM('active', 'hidden', 'deleted') DEFAULT 'active',
    views INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_category (category),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at),
    INDEX idx_province_city (province, city),
    INDEX idx_views (views),
    CONSTRAINT fk_forum_posts_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Forum Comments Table
-- Stores comments/replies on forum posts
CREATE TABLE IF NOT EXISTS forum_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    parent_comment_id INT NULL,
    content TEXT NOT NULL,
    status ENUM('active', 'hidden', 'deleted') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_post_id (post_id),
    INDEX idx_user_id (user_id),
    INDEX idx_parent_comment (parent_comment_id),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at),
    CONSTRAINT fk_forum_comments_post FOREIGN KEY (post_id) REFERENCES forum_posts(id) ON DELETE CASCADE,
    CONSTRAINT fk_forum_comments_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT fk_forum_comments_parent FOREIGN KEY (parent_comment_id) REFERENCES forum_comments(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- User Blocks Table
-- Stores user-to-user blocks
CREATE TABLE IF NOT EXISTS user_blocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    blocker_user_id INT NOT NULL,
    blocked_user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_block (blocker_user_id, blocked_user_id),
    INDEX idx_blocker (blocker_user_id),
    INDEX idx_blocked (blocked_user_id),
    CONSTRAINT fk_user_blocks_blocker FOREIGN KEY (blocker_user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT fk_user_blocks_blocked FOREIGN KEY (blocked_user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- MODERATION & REPORTING
-- ============================================================================

-- Reports Table
-- Stores user reports for pets, users, or other content
CREATE TABLE IF NOT EXISTS reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reporter_user_id INT NULL,
    report_type ENUM('pet', 'user', 'application', 'message', 'other') NOT NULL,
    reported_item_id INT NOT NULL,
    reported_user_id INT NULL,
    reason ENUM('spam', 'scam', 'inappropriate', 'abuse', 'fake', 'animal_welfare', 'other') NOT NULL,
    description TEXT NOT NULL,
    status ENUM('pending', 'reviewed', 'resolved', 'dismissed') DEFAULT 'pending',
    admin_notes TEXT NULL,
    reviewed_by INT NULL,
    reviewed_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_report_type (report_type, reported_item_id),
    INDEX idx_reporter (reporter_user_id),
    INDEX idx_reported_user (reported_user_id),
    INDEX idx_created_at (created_at),
    CONSTRAINT fk_reports_reporter FOREIGN KEY (reporter_user_id) REFERENCES users(user_id) ON DELETE SET NULL,
    CONSTRAINT fk_reports_reported_user FOREIGN KEY (reported_user_id) REFERENCES users(user_id) ON DELETE SET NULL,
    CONSTRAINT fk_reports_reviewer FOREIGN KEY (reviewed_by) REFERENCES administrators(adminID) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Forum Post Reports Table
-- Stores reports on forum posts for moderation
CREATE TABLE IF NOT EXISTS forum_post_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reporter_user_id INT NULL,
    post_id INT NOT NULL,
    reported_user_id INT NOT NULL,
    reason ENUM('spam', 'inappropriate', 'abuse', 'off_topic', 'misinformation', 'other') NOT NULL,
    description TEXT NOT NULL,
    status ENUM('pending', 'reviewed', 'resolved', 'dismissed') DEFAULT 'pending',
    admin_notes TEXT NULL,
    reviewed_by INT NULL,
    reviewed_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_post_id (post_id),
    INDEX idx_reporter (reporter_user_id),
    INDEX idx_reported_user (reported_user_id),
    INDEX idx_created_at (created_at),
    CONSTRAINT fk_forum_reports_reporter FOREIGN KEY (reporter_user_id) REFERENCES users(user_id) ON DELETE SET NULL,
    CONSTRAINT fk_forum_reports_post FOREIGN KEY (post_id) REFERENCES forum_posts(id) ON DELETE CASCADE,
    CONSTRAINT fk_forum_reports_reported_user FOREIGN KEY (reported_user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT fk_forum_reports_reviewer FOREIGN KEY (reviewed_by) REFERENCES administrators(adminID) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- NOTIFICATIONS & MEDIA
-- ============================================================================

-- Email Queue Table
-- Stores email notifications to be sent
CREATE TABLE IF NOT EXISTS email_queue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recipient_email VARCHAR(120) NOT NULL,
    recipient_name VARCHAR(100) NULL,
    subject VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    email_type VARCHAR(50) NOT NULL,
    status ENUM('pending', 'sent', 'failed') DEFAULT 'pending',
    attempts INT DEFAULT 0,
    sent_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_created_at (created_at),
    INDEX idx_email_type (email_type),
    INDEX idx_recipient_email (recipient_email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- User Profile Pictures Table
-- Stores user profile picture information
CREATE TABLE IF NOT EXISTS user_profile_pictures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    image_path VARCHAR(255) NOT NULL,
    image_name VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    CONSTRAINT fk_profile_pictures_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- DEVELOPMENT SEED DATA
-- ============================================================================
-- WARNING: These seeds are for DEVELOPMENT ONLY!
-- DO NOT run these in production environments!
-- 
-- Default credentials:
--   - Admin: email: admin@example.com, password: password
--   - User: username: janedoe, email: jane@example.com, password: password
--
-- IMPORTANT: Change all default passwords immediately after installation!
-- ============================================================================

-- Seed: Default administrator (password: password)
INSERT INTO administrators (firstName, lastName, emailAddress, password)
VALUES ('Site', 'Admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')
ON DUPLICATE KEY UPDATE emailAddress = emailAddress;

-- Seed: Demo user (password: password)
INSERT INTO users (name, username, email, phone, password)
VALUES ('Jane Doe', 'janedoe', 'jane@example.com', '555-111-2222', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')
ON DUPLICATE KEY UPDATE email = email;

-- Seed: Sample pets for demonstration
INSERT INTO pets (user_id, pet_name, pet_type, breed, age, description, city, fee, gender, vaccination_status, status) VALUES
(NULL, 'Max', 'Dog', 'Labrador', 2, '[SAMPLE PET] Max is a playful Labrador puppy. He is quiet and cuddly. He is hoping to find a new forever home with a loving family.', 'Vancouver', 50.00, 'Male', 'up_to_date', 'approved'),
(NULL, 'Buddy', 'Dog', 'Golden Retriever', 1, '[SAMPLE PET] A friendly and adorable golden retriever puppy who loves to play fetch and sleep with his owner. He loves walks and gets along well with kids.', 'Toronto', 75.00, 'Male', 'up_to_date', 'approved'),
(NULL, 'Charlie', 'Bird', 'Parakeet', 1, '[SAMPLE PET] A calm and affectionate parakeet. A low maintenance and fun new pet for your family to enjoy. Looking for a new forever home.', 'Montreal', 25.00, 'Male', 'partial', 'approved'),
(NULL, 'Luna', 'Cat', 'Domestic Shorthair', 3, '[SAMPLE PET] Calm, cuddly, and curious', 'Toronto', 30.00, 'Female', 'up_to_date', 'approved')
ON DUPLICATE KEY UPDATE pet_name = pet_name;

-- Seed: Sample pet images
INSERT INTO pet_images (user_id, pet_id, image_name, image_path) VALUES
(NULL, 1, 'max.png', 'images/max.png'),
(NULL, 2, 'buddy.png', 'images/buddy.png'),
(NULL, 3, 'bird.jpg', 'images/bird.jpg'),
(NULL, 4, 'luna.jpg', 'images/luna.jpg')
ON DUPLICATE KEY UPDATE image_path = image_path;
