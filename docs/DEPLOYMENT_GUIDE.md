# Pawsitive Placements - Deployment & Testing Guide

**Author:** Lindsey D. Stead  
**Date:** November 7, 2025  
**Version:** 1.0

Complete guide for uploading and testing the application in both local and production environments.

---

## 📦 Local Testing (XAMPP)

### Step 1: Setup XAMPP

1. **Download and Install XAMPP**
   - Download from: https://www.apachefriends.org/
   - Install to default location (usually `C:\xampp`)

2. **Start Services**
   - Open XAMPP Control Panel
   - Start **Apache** service
   - Start **MySQL** service

### Step 2: Install the Application

1. **Copy Project to htdocs**
   - Your project is already at: `C:\xampp\htdocs\PawsitivePlacements`
   - ✅ Already in the right place!

2. **Create .env File**
   - Create a file named `.env` in the project root (`C:\xampp\htdocs\PawsitivePlacements\.env`)
   - Add the following content:
   ```env
   DB_HOST=localhost
   DB_NAME=pawsitiveplacements
   DB_USER=root
   DB_PASS=
   DB_CHARSET=utf8mb4
   APP_ENV=development
   ```

### Step 3: Setup Database

1. **Access phpMyAdmin**
   - Open browser: `http://localhost/phpmyadmin`
   - Login (usually no password for root user)

2. **Create Database**
   - Click "New" in left sidebar
   - Database name: `pawsitiveplacements`
   - Collation: `utf8mb4_unicode_ci`
   - Click "Create"

3. **Import Schema**
   - Select the `pawsitiveplacements` database
   - Click "Import" tab
   - Click "Choose File"
   - Select: `C:\xampp\htdocs\PawsitivePlacements\database\schema.sql`
   - Click "Go" at bottom
   - ✅ Database should be created with all tables and seed data

### Step 4: Test the Application

1. **Access the Application**
   - Open browser: `http://localhost/PawsitivePlacements`
   - You should see the home page

2. **Test Default Login**
   - **Admin**: 
     - Go to Admin Menu
     - Email: `admin@example.com`
     - Password: `password`
   - **User**:
     - Go to User Login
     - Username: `janedoe`
     - Password: `password`

3. **Run Test Suite**
   - Open terminal/command prompt
   - Navigate to project: `cd C:\xampp\htdocs\PawsitivePlacements`
   - Run: `php tests/run_tests.php`
   - ✅ All tests should pass

---

## 🌐 Uploading to Web Server

### Option 1: cPanel / Shared Hosting

1. **Prepare Files**
   - Create a ZIP file of the entire project (except `.env` file)
   - Files to include:
     - All PHP files
     - All directories (admins, api, application, etc.)
     - `database/schema.sql`
     - `README.md`
     - `.gitignore`
     - `LICENSE`
   - Files to EXCLUDE:
     - `.env` (create new one on server)
     - `images/*.jpg`, `images/*.png` (user uploads - optional)

2. **Upload via cPanel File Manager**
   - Login to cPanel
   - Open "File Manager"
   - Navigate to `public_html` (or your domain folder)
   - Upload and extract the ZIP file
   - Or upload via FTP (see Option 2)

3. **Create .env File on Server**
   - In File Manager, create new file: `.env`
   - Add your database credentials:
   ```env
   DB_HOST=localhost
   DB_NAME=your_database_name
   DB_USER=your_database_user
   DB_PASS=your_database_password
   DB_CHARSET=utf8mb4
   APP_ENV=production
   ```
   - ⚠️ **Important**: Get these from your hosting provider's database section

4. **Create Database on Server**
   - In cPanel, go to "MySQL Databases"
   - Create a new database (e.g., `username_pawsitive`)
   - Create a database user
   - Add user to database with ALL PRIVILEGES
   - Note the database name, username, and password

5. **Import Database Schema**
   - In cPanel, go to "phpMyAdmin"
   - Select your database
   - Click "Import" tab
   - Upload `database/schema.sql`
   - Click "Go"

6. **Set Permissions**
   - In File Manager, set `images/` folder permissions to `755` or `777` (writable)
   - Set `.env` file permissions to `644` (readable, not writable by public)

7. **Test the Application**
   - Visit: `http://yourdomain.com/PawsitivePlacements`
   - Or: `http://yourdomain.com` (if uploaded to root)

### Option 2: FTP Upload

1. **Get FTP Credentials**
   - From your hosting provider
   - Usually: hostname, username, password, port (usually 21)

2. **Use FTP Client**
   - Recommended: FileZilla (free)
   - Download: https://filezilla-project.org/

3. **Connect to Server**
   - Enter FTP credentials
   - Connect to server

4. **Upload Files**
   - Navigate to `public_html` or your domain folder on server
   - Upload all project files
   - Maintain folder structure

5. **Follow Steps 3-7 from Option 1** (Create .env, database, etc.)

### Option 3: Git Deployment

1. **Push to GitHub**
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git remote add origin https://github.com/yourusername/PawsitivePlacements.git
   git push -u origin main
   ```

2. **Deploy via Git on Server**
   - SSH into your server
   - Clone repository:
   ```bash
   cd public_html
   git clone https://github.com/yourusername/PawsitivePlacements.git
   ```

3. **Setup on Server** (same as Option 1, steps 3-7)

---

## 🧪 Testing Checklist

### Pre-Deployment Testing

- [ ] Run test suite: `php tests/run_tests.php`
- [ ] Check PHP syntax: No errors
- [ ] Verify `.env` file exists (not in git)
- [ ] Database schema imported successfully
- [ ] All required files present

### Functional Testing

#### User Features
- [ ] **Registration**: Create new account
- [ ] **Login**: Login with test user
- [ ] **Profile**: Edit profile information
- [ ] **Browse Pets**: View pet listings
- [ ] **Search**: Search for pets
- [ ] **Filter**: Filter by city, type
- [ ] **Pet Details**: View individual pet pages
- [ ] **Apply**: Submit adoption application
- [ ] **Rehome**: Submit pet for rehoming
- [ ] **Forum**: Create forum post
- [ ] **Forum**: Comment on posts
- [ ] **Contact**: Submit contact form

#### Admin Features
- [ ] **Admin Login**: Login as admin
- [ ] **View Users**: See user list
- [ ] **Manage Users**: Suspend/ban users
- [ ] **View Pets**: See all pets
- [ ] **Approve Pets**: Change pet status
- [ ] **View Applications**: See adoption applications
- [ ] **View Messages**: See contact messages
- [ ] **Manage Admins**: Add/delete administrators

#### Security Testing
- [ ] **CSRF**: Try submitting form without token (should fail)
- [ ] **SQL Injection**: Try SQL in search fields (should be safe)
- [ ] **XSS**: Try script tags in forms (should be escaped)
- [ ] **File Upload**: Try uploading non-image file (should be rejected)
- [ ] **Authentication**: Try accessing admin without login (should redirect)
- [ ] **Password Reset**: Test password reset flow

### Post-Deployment Testing

- [ ] **Homepage**: Loads correctly
- [ ] **Database**: Connection works
- [ ] **Images**: Pet images display
- [ ] **Forms**: All forms submit correctly
- [ ] **Email**: Contact form works (if email configured)
- [ ] **Performance**: Pages load quickly
- [ ] **Mobile**: Test on mobile device
- [ ] **Browser**: Test in Chrome, Firefox, Safari

---

## 🔧 Troubleshooting

### Common Issues

#### "Database connection failed"
- ✅ Check `.env` file exists and has correct credentials
- ✅ Verify database name, user, password are correct
- ✅ Check database server is running
- ✅ Verify database user has proper permissions

#### "404 Not Found"
- ✅ Check file paths are correct
- ✅ Verify `.htaccess` if using URL rewriting
- ✅ Check Apache mod_rewrite is enabled
- ✅ Verify files uploaded to correct directory

#### "Permission denied" on images folder
- ✅ Set `images/` folder permissions to `755` or `777`
- ✅ Check folder ownership matches web server user

#### "CSRF token invalid"
- ✅ Check session is working
- ✅ Verify cookies are enabled
- ✅ Check `util/session.php` is loaded

#### "Class not found" or "Function not found"
- ✅ Check all `require_once` paths are correct
- ✅ Verify all model files are uploaded
- ✅ Check file permissions (should be readable)

#### Images not displaying
- ✅ Check image paths are correct (relative paths)
- ✅ Verify images folder exists and is accessible
- ✅ Check file permissions on images
- ✅ Verify image URLs in database are correct

---

## 📋 Pre-Upload Checklist

Before uploading to production:

- [ ] ✅ Remove `.env` from upload (create new on server)
- [ ] ✅ Change default passwords in database
- [ ] ✅ Update `APP_ENV=production` in `.env`
- [ ] ✅ Test all features locally first
- [ ] ✅ Run test suite: `php tests/run_tests.php`
- [ ] ✅ Check for any hardcoded localhost URLs
- [ ] ✅ Verify all sensitive data is in `.env`
- [ ] ✅ Test database connection
- [ ] ✅ Backup existing database (if updating)

---

## 🚀 Quick Start Commands

### Local Testing
```bash
# Navigate to project
cd C:\xampp\htdocs\PawsitivePlacements

# Run tests
php tests/run_tests.php

# Check PHP syntax
php -l index.php
```

### Server Testing (via SSH)
```bash
# Navigate to project
cd public_html/PawsitivePlacements

# Run tests
php tests/run_tests.php

# Check file permissions
chmod 755 images/
chmod 644 .env
```

---

## 📞 Support

If you encounter issues:

1. **Check Error Logs**
   - XAMPP: `C:\xampp\apache\logs\error.log`
   - Server: Usually in cPanel "Error Log" section

2. **Check PHP Errors**
   - Enable error display in development
   - Check `php.ini` settings

3. **Database Issues**
   - Verify credentials in `.env`
   - Test connection in phpMyAdmin
   - Check database user permissions

4. **File Permissions**
   - Folders: `755` or `775`
   - Files: `644` or `664`
   - Executable scripts: `755`

---

## ✅ Success Indicators

Your app is working correctly if:

- ✅ Homepage loads without errors
- ✅ Can create user account
- ✅ Can login as user and admin
- ✅ Can browse and search pets
- ✅ Can submit adoption application
- ✅ Can submit pet for rehoming
- ✅ Forum posts and comments work
- ✅ Admin panel accessible
- ✅ All forms submit successfully
- ✅ Images display correctly

---

**Ready to deploy!** Follow the steps above and your application will be live and working. 🎉

