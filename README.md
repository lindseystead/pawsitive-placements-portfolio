# Pawsitive Placements

**Full-stack PHP/MySQL pet adoption platform** | Production-ready | BC PIPA-compliant

[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![MariaDB](https://img.shields.io/badge/MariaDB-10.4+-003545?style=flat&logo=mariadb&logoColor=white)](https://mariadb.org/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-4.5-7952B3?style=flat&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-Proprietary-red.svg)](LICENSE)
[![Testing](https://img.shields.io/badge/Testing-Comprehensive-green.svg)](docs/TEST_REPORT.md)
[![Security](https://img.shields.io/badge/Security-CSRF%20%7C%20SQL%20Injection%20Protected-brightgreen.svg)](#security-implementation)
[![Database](https://img.shields.io/badge/Database-19%20Tables-blue.svg)](database/schema.sql)
[![Visitor Count](https://visitor-badge.laobi.icu/badge?page_id=lindseystead.pawsitive-placements-portfolio)](https://github.com/lindseystead/pawsitive-placements-portfolio)
[![Last Commit](https://img.shields.io/github/last-commit/lindseystead/pawsitive-placements-portfolio)](https://github.com/lindseystead/pawsitive-placements-portfolio)


**Live Demo:** www.pawsitiveplacements.ca — *Full deployment coming soon.*

> **Project Overview:** A production-ready, full-stack web application developed as a solo project. Features complete backend, frontend, and database design. This proprietary application demonstrates enterprise-level development practices. This repository contains selected portfolio samples and documentation. The full codebase is available for portfolio review and technical evaluation upon request. See [Code Access](#code-access) section below. 

---

## 📸 Screenshots

### Homepage
![Homepage](screenshots/homepage.png)
*Landing page featuring hero section, featured pets, and platform overview*

### Available Pets
![Available Pets](screenshots/availablepets.png)
*Pet listing page with advanced search, filtering, and pagination functionality*

### Pet Details
![Pet Details](screenshots/samplepet.png)
*Individual pet detail page with comprehensive information and adoption application form*

### Community Forum
![Community Forum](screenshots/communityforum.png)
*Community forum with categorized posts, user profiles, and engagement features*

---

## 🎯 Project Overview

A production-ready pet adoption platform connecting pet owners with potential adopters across British Columbia. The application features comprehensive user management, advanced pet search capabilities, adoption application workflows, community forum functionality, and an extensive administrative panel with enterprise-level SEO optimization.

**Key Impact:**
- Streamlines the pet rehoming process with established ethical standards
- Provides a secure, user-friendly platform for pet adoption
- Implements BC PIPA-compliant privacy and data protection measures
- Enterprise-level SEO implementation targeting 200-300% organic traffic growth

---

## 📊 By The Numbers

| Metric | Value |
|--------|-------|
| **Codebase** | 71 PHP files, 14,110+ lines |
| **Database** | 19 normalized tables |
| **API Endpoints** | 4 RESTful AJAX endpoints |
| **Admin Pages** | 13 management interfaces |
| **User Pages** | 11 user account interfaces |
| **Security** | 100% CSRF-protected, zero SQL injection vulnerabilities |
| **SEO** | Dynamic meta tags, JSON-LD structured data, XML sitemap |

---

## 🏗️ Architecture

**MVC Pattern with RESTful API Integration**

```
┌─────────────────┐
│  Frontend       │  Bootstrap 4.5 | jQuery | AJAX
│  (Views)        │
└────────┬────────┘
         │
┌────────▼────────┐
│  Controllers    │  PHP 8.2+ | Session Management
│  (Business      │
│   Logic)        │
└────────┬────────┘
         │
┌────────▼────────┐      ┌──────────────┐
│  Models         │◄────►│  Database    │
│  (PDO)          │      │  (MariaDB)   │
└────────┬────────┘      └──────────────┘
         │
┌────────▼────────┐
│  RESTful API     │  AJAX Endpoints | JSON Responses
│  (AJAX)         │
└─────────────────┘
```

**Key Design Decisions:**
- **MVC Separation:** Clean architecture for maintainability
- **PDO Prepared Statements:** 100% SQL injection prevention
- **CSRF Tokens:** All forms protected
- **Progressive Enhancement:** AJAX with traditional form fallbacks
- **SEO-First:** Dynamic meta tags, structured data per page

---

## 🛠️ Tech Stack

**Backend:** PHP 8.2+ | MariaDB/MySQL | PDO | RESTful API | Session Management

**Frontend:** Bootstrap 4.5.2 | jQuery 3.5.1 | AJAX | Font Awesome | Responsive Design

**Database:** 19 normalized tables | Foreign keys | Indexes | Seed data

**SEO & Marketing:** Dynamic meta tags | JSON-LD structured data | XML sitemap | Social sharing | Newsletter system

**Security:** CSRF tokens | bcrypt hashing | PDO prepared statements | XSS prevention | File upload validation

**DevOps:** Apache .htaccess | Environment variables | Production-ready schema

---

## 🔒 Security Implementation

- ✅ **CSRF Protection:** Token-based validation on all forms
- ✅ **SQL Injection Prevention:** 100% PDO prepared statements (zero raw queries)
- ✅ **XSS Prevention:** `htmlspecialchars()` on all user output
- ✅ **Password Security:** bcrypt hashing with `password_hash()`
- ✅ **File Uploads:** MIME validation, size limits, random filenames
- ✅ **Session Security:** HttpOnly cookies, secure configuration, regeneration
- ✅ **Input Validation:** Server-side filtering with `filter_input()`
- ✅ **Privacy Compliance:** BC PIPA-compliant implementation

---

## 🗄️ Database Design

**Normalized relational database with 19 tables, foreign key constraints, and optimized indexes.**

### Schema Overview
- **19 Normalized Tables:** Users, administrators, pets, pet_images, addresses, applications, messages, contact forms, newsletter subscriptions, site visits, password resets, rate limits, forum posts, forum comments, user blocks, reports, forum post reports, email queue, and user profile pictures
- **Foreign Key Relationships:** Enforced referential integrity across all relationships
- **Indexed Columns:** Optimized queries on email, username, pet_id, user_id, and timestamps
- **Data Types:** Appropriate VARCHAR lengths, ENUM types for status fields, DECIMAL for fees
- **Character Set:** utf8mb4 for full Unicode support (emojis, international characters)

### Key Design Decisions
- **Normalization:** 3NF compliance prevents data redundancy
- **Foreign Keys:** CASCADE and SET NULL behaviors for data integrity
- **Indexes:** Strategic indexing on frequently queried columns (email, username, timestamps)
- **ENUM Types:** Status fields (account_status, pet_status) for data consistency
- **Timestamps:** Automatic `created_at` and `updated_at` tracking on all tables
- **Soft Deletes:** Status-based deletion (e.g., `account_status = 'banned'`) preserves audit trail

### Database Features
- **User Management:** Email verification, account status tracking (active/suspended/banned), phone verification
- **Pet Management:** Listings with vaccination status, adoption fees, multiple images per pet, status workflow
- **Adoption System:** Application workflow with status tracking, messaging between users
- **Community Forum:** Posts with categories, threaded comments, view tracking, location-based filtering
- **Moderation:** User blocking system, comprehensive reporting (pets, users, applications, messages, forum posts)
- **Communication:** Contact form submissions (supports both logged-in and anonymous users), email queue system
- **Marketing:** Newsletter subscription management with unsubscribe tracking
- **Analytics:** Site visit counter with session-based tracking
- **Security:** Rate limiting for spam prevention, password reset tokens, secure authentication
- **Media:** User profile pictures, pet image galleries

**See:** `database/schema.sql` for complete schema documentation

---

## 🧪 Testing & Quality Assurance

**Comprehensive testing methodology ensuring production-ready reliability and code quality.**

### Testing Methodology
- **Static Code Analysis:** PHP syntax validation via automated test runner (`tests/run_tests.php`), file structure verification
- **Code Review:** Comprehensive manual review of all 71 PHP files and feature implementations
- **Security Audits:** CSRF protection verification, SQL injection prevention (100% PDO prepared statements), XSS validation
- **Feature Testing:** All major features manually reviewed and verified (user management, pet management, adoption flow, forum, admin panel)
- **Database Integrity:** Schema validation, foreign key constraint verification, normalization compliance
- **Security Testing:** Password hashing verification, session management review, input validation testing

### Test Coverage
✅ **User Management:** Registration, login, profile editing, password reset  
✅ **Pet Management:** Listing, search, filtering, detail views  
✅ **Adoption Flow:** Application submission, status tracking  
✅ **Forum System:** Post creation, comments, user interactions  
✅ **Admin Panel:** CRUD operations, user management, moderation  
✅ **Security:** CSRF tokens, prepared statements, XSS prevention  
✅ **File Uploads:** Image validation, MIME checking, size limits  
✅ **API Endpoints:** JSON responses, error handling, status codes  

### Quality Metrics
- **Code Quality:** Professional documentation, consistent structure, error handling
- **Security:** 100% CSRF-protected forms, zero SQL injection vulnerabilities
- **Performance:** Indexed queries, optimized database operations
- **Maintainability:** MVC architecture, separation of concerns, reusable components

**See:** `docs/TEST_REPORT.md` for detailed testing documentation

---

## 💼 Engineering Skills Demonstrated

- **Full-Stack Development:** PHP backend + Bootstrap frontend with MVC architecture
- **Database Design:** Normalized schema with 19 tables, foreign keys, indexes
- **API Development:** RESTful AJAX endpoints with JSON responses
- **Security:** CSRF, SQL injection prevention, XSS protection, password hashing
- **SEO Optimization:** Dynamic meta tags, structured data (JSON-LD), sitemap generation
- **User Experience:** Responsive design, AJAX interactions, intuitive navigation
- **Admin Systems:** Comprehensive CRUD operations, user management, moderation
- **File Handling:** Secure uploads with validation and MIME checking
- **Code Quality:** Professional documentation, consistent structure, error handling
- **Testing:** Static analysis, security audits, feature verification

---

## 📁 Project Structure

**Note:** This repository contains selected portfolio samples and documentation. The full codebase (71 PHP files, 14,110+ lines) is proprietary and available for review upon request.

### Repository Contents

```
pawsitive-placements-portfolio/
├── portfolio-samples/    # Selected code samples (6 key files)
│   ├── api/              # API endpoint sample
│   ├── model/            # Database model sample
│   ├── pets/             # Pet detail page sample
│   ├── util/             # Utility samples (CSRF, SEO)
│   └── view/             # Header component sample
├── database/             # Database schema (structure only)
│   └── schema.sql        # Complete schema documentation
├── docs/                 # Project documentation
│   ├── TEST_REPORT.md
│   ├── DEPLOYMENT_GUIDE.md
│   └── PROJECT_STRUCTURE.md
├── screenshots/          # Application screenshots
├── styles/               # CSS stylesheets
├── js/                   # JavaScript files
├── view/                 # Shared view components
├── pets/                 # Pet listing pages (sample)
├── README.md             # This file
└── LICENSE               # Proprietary license
```

### Full Application Structure

The complete application includes:
- **71 PHP files** across 15+ directories
- **19 database tables** with full normalization and foreign key constraints
- **Admin panel** (13 management interfaces: users, pets, applications, messages, administrators)
- **User management system** (registration, profiles, authentication, email verification, password reset)
- **Pet management** (listings, search, filtering, details, multiple images, vaccination tracking)
- **Adoption application workflow** (application submission, status tracking, user messaging)
- **Community forum** (categorized posts, threaded comments, moderation, location filtering)
- **RESTful API** (4 AJAX endpoints: applications, contact, newsletter, pet rehoming)
- **Security utilities** (CSRF protection, session management, input validation, rate limiting)
- **Moderation system** (user blocking, comprehensive reporting system)
- **SEO optimization** (dynamic meta tags, JSON-LD structured data, XML sitemap)
- **Email system** (email queue, newsletter subscriptions, notifications)

**See:** `portfolio-samples/README.md` for details on included code samples.

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.2 or higher
- MariaDB/MySQL 10.4 or higher
- Apache web server
- XAMPP, WAMP, or equivalent LAMP/WAMP stack

### Installation Steps

```bash
# 1. Clone repository
git clone <repository-url>
cd PawsitivePlacements

# 2. Import database schema
# Import database/schema.sql into your MySQL/MariaDB instance

# 3. Configure database credentials
# Update database connection settings in model/database.php

# 4. Start Apache and MySQL services
# Using XAMPP Control Panel or equivalent

# 5. Access application
# Navigate to http://localhost/PawsitivePlacements/
```

**Default Administrator Credentials:** `admin@pawsitiveplacements.ca` / `Admin123!`  
*Note: Change default credentials immediately in production environments.*

---

## 🔐 Code Access

This is **proprietary software**.  
Source code is available **for portfolio review and technical evaluation only**.

### ▶️ For Recruiters & Hiring Managers

You are welcome to:

* ✔ Review the code for technical skill assessment
* ✔ Inspect the architecture and implementation details
* ✔ Discuss this project during interviews

For private repository access or a secure demo:  
📧 **info@lifesavertech.ca**

### 🚫 For Commercial Use

Commercial use, deployment, resale, or distribution **requires a valid commercial license**.

Licensing inquiries:  
**Lifesaver Technology Services**  
📧 **info@lifesavertech.ca**

---

## 📄 License & Intellectual Property

**Intellectual Property Ownership**  
This project was designed, created, and implemented by **Lindsey D. Stead**.  
All intellectual property rights are owned exclusively by **Lindsey D. Stead**.  
**Copyright © 2025 Lindsey D. Stead. All Rights Reserved.**

This repository is provided **for portfolio demonstration purposes only**.  
No commercial use is permitted without explicit written consent and a licensing agreement.

---

**Built with ❤️ to support ethical pet adoption and rehoming across Canada.**


