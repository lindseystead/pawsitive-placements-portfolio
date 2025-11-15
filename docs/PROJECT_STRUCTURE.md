# Pawsitive Placements - Project Structure

**Author:** Lindsey D. Stead  
**Date:** November 7, 2025  
**Version:** 1.0

This document describes the complete project structure, file naming conventions, and architectural decisions for the Pawsitive Placements application.

## 📁 Directory Structure

```
PawsitivePlacements/
├── about/                  # About page
│   └── about.php          # About us page view
│
├── admins/                 # Admin panel
│   ├── add-administrator.php    # Add new administrator form
│   ├── administrators.php       # List all administrators
│   ├── applications.php          # Manage adoption applications
│   ├── edit-pet.php              # Edit pet information (admin)
│   ├── index.php                 # Admin controller (routing)
│   ├── login.php                 # Admin login page
│   ├── menu.php                  # Admin dashboard
│   ├── messages.php              # View and manage messages
│   ├── pets.php                  # Manage all pets
│   ├── reply-message.php        # Reply to user messages
│   ├── reset-password.php        # Admin password reset request
│   ├── reset-password-form.php   # Admin password reset form
│   └── users.php                 # Manage all users
│
├── api/                    # API endpoints (AJAX handlers)
│   ├── application.php     # POST: Submit adoption application
│   ├── contact.php        # POST: Submit contact form
│   └── pet-rehome.php     # POST: Submit pet for rehoming
│
├── application/            # Adoption application system
│   ├── form.php           # Adoption application form view
│   └── index.php          # Application controller
│
├── contact/                # Contact form
│   ├── form.php           # Contact form view
│   └── index.php          # Contact controller
│
├── database/               # Database schema
│   └── schema.sql         # Complete database schema with seed data
│
├── docs/                   # Documentation
│   ├── DEPLOYMENT_GUIDE.md      # Deployment instructions
│   ├── PROJECT_STRUCTURE.md     # This file
│   └── TEST_REPORT.md           # Test results and analysis
│
├── errors/                 # Error pages
│   ├── db_error_connect.php    # Database connection error
│   └── error.php               # General error page
│
├── forum/                  # Community forum
│   ├── create.php         # Create new forum post
│   ├── index.php          # Forum controller
│   ├── list.php           # Forum post listing
│   └── view.php           # View post with comments
│
├── images/                 # Pet images and assets
│   ├── logo.png
│   ├── pawsitive_placements.png
│   ├── dog_and_cat.png
│   └── [uploaded pet images]    # User-uploaded pet photos
│
├── js/                     # JavaScript files
│   └── ajax-handler.js    # Centralized AJAX form handler
│
├── model/                  # Data access layer (MVC Models)
│   ├── address_db.php     # Address CRUD operations
│   ├── admin_db.php       # Administrator operations
│   ├── adoption_db.php    # Adoption application operations
│   ├── database.php       # Database connection and configuration
│   ├── email_db.php       # Email management
│   ├── forum_db.php      # Forum post and comment operations
│   ├── pet_db.php         # Pet CRUD operations
│   ├── rate_limit_db.php  # Rate limiting operations
│   ├── reports_db.php     # Report management
│   └── users_db.php       # User CRUD operations
│
├── pets/                   # Pet listing and details
│   ├── index.php          # Pet controller (routing)
│   ├── pet_detail.php     # Pet detail view
│   └── pet_list.php       # Pet listing view
│
├── pet-rehome/             # Pet rehoming functionality
│   ├── index.php          # Rehome controller
│   └── upload.php         # Rehome form view
│
├── styles/                 # CSS stylesheets
│   └── main.css           # Main stylesheet with custom styles
│
├── tests/                  # Test files
│   └── run_tests.php      # Test runner script
│
├── user/                   # User account management
│   ├── account.php        # User dashboard
│   ├── addresses.php      # Address management view
│   ├── applications.php   # User's adoption applications
│   ├── create_account.php # User registration form
│   ├── edit-pet.php       # Edit user's pet listing
│   ├── edit-profile.php   # Edit user profile
│   ├── index.php          # User controller (routing)
│   ├── login.php          # User login form
│   ├── pets.php           # User's pet listings
│   ├── reset-password.php # Password reset request
│   └── reset-password-form.php # Password reset form
│
├── util/                   # Utility functions
│   ├── csrf.php           # CSRF token generation and validation
│   ├── env.php            # Environment variable loader
│   ├── secure_conn.php    # HTTPS enforcement
│   ├── session.php        # Session management
│   ├── valid_admin.php    # Admin authentication guard
│   └── valid_user.php     # User authentication guard
│
├── view/                   # Shared view components
│   ├── footer.php         # Page footer (shared)
│   ├── header.php         # Page header/navigation (shared)
│   ├── sidebar.php        # User sidebar (shared)
│   ├── sidebar_admin.php  # Admin sidebar (shared)
│   └── terms-of-use.php   # Terms and conditions page
│
├── .env                    # Environment variables (not in repo)
├── .gitignore             # Git ignore rules
├── home.php               # Home page view
├── index.php              # Application entry point
├── LICENSE                # MIT License
├── QUICK_START.md         # Quick start guide
└── README.md              # Main documentation
```

## 📝 File Naming Conventions

### PHP Files
- **Controllers**: `index.php` (within feature directories)
- **Views**: Descriptive names (e.g., `pet_list.php`, `create_account.php`)
- **Models**: `*_db.php` suffix (e.g., `pet_db.php`, `users_db.php`)
- **Utilities**: Descriptive names (e.g., `csrf.php`, `session.php`)
- **API Endpoints**: Descriptive names (e.g., `application.php`, `contact.php`)

### Directory Naming
- Use lowercase with hyphens for multi-word directories (e.g., `pet-rehome/`)
- Use singular nouns for feature directories (e.g., `user/`, `admin/`)
- Use plural for collections (e.g., `pets/`, `admins/`)

### CSS/JavaScript
- Main stylesheet: `main.css`
- JavaScript files: Descriptive names with hyphens (e.g., `ajax-handler.js`)

## 🏗 Architecture Patterns

### MVC (Model-View-Controller)
- **Models** (`model/`): Data access layer, database operations
- **Views** (feature directories): Presentation layer, HTML/PHP templates
- **Controllers** (`index.php` files): Business logic, routing, request handling

### Separation of Concerns
- **Database Logic**: Isolated in model files
- **Business Logic**: In controllers
- **Presentation**: In view files
- **Utilities**: Reusable functions in `util/`

### Security Layers
- **Authentication**: `util/valid_user.php`, `util/valid_admin.php`
- **CSRF Protection**: `util/csrf.php`
- **Input Validation**: In controllers and models
- **Output Escaping**: In views with `htmlspecialchars()`

## 📚 Code Documentation Standards

All PHP files follow this header format:

```php
<?php
/**
 * Pawsitive Placements
 * 
 * @file       path/to/file.php
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Brief description of the file's purpose and functionality.
 */
```

All functions include PHPDoc comments:

```php
/**
 * Function description
 * 
 * @param type $paramName Parameter description
 * @return type Return value description
 * @throws ExceptionType When this exception is thrown
 */
```

## 🔐 Security Considerations

### File Organization
- Sensitive files (`.env`) are excluded from version control
- Database credentials stored in environment variables
- Uploaded files stored in `images/` with proper permissions

### Access Control
- Admin pages require `util/valid_admin.php`
- User pages require `util/valid_user.php`
- Public pages have no authentication requirements

### Input/Output
- All user input sanitized with `filter_input()`
- All output escaped with `htmlspecialchars()`
- File uploads validated for MIME type and size

## 📊 Database Schema

The database schema is defined in `database/schema.sql` and includes:

- **Core Tables**: users, administrators, pets, applications
- **Supporting Tables**: addresses, messages, pet_images
- **Forum Tables**: forum_posts, forum_comments, forum_reports
- **System Tables**: contact_form_submissions, rate_limits

All tables use:
- InnoDB engine for foreign key support
- utf8mb4 charset for full Unicode support
- Proper indexes for performance
- Foreign key constraints for data integrity

## 🚀 Deployment Considerations

### Required Permissions
- `images/` directory: Write permissions (755 or 777)
- `.env` file: Read permissions (644)

### Environment-Specific Files
- Development: `.env` with `APP_ENV=development`
- Production: `.env` with `APP_ENV=production` and `FORCE_HTTPS=true`

### File Structure
- All paths use relative references
- Base path calculation in `view/header.php` and `view/footer.php`
- Consistent use of `__DIR__` for reliable includes

---

**Documentation maintained by:** Lindsey D. Stead  
**Last Updated:** November 7, 2025
