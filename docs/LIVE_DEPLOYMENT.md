# 🚀 Live Deployment Guide - Pawsitive Placements

**Author:** Lindsey D. Stead  
**Date:** November 2025  
**Version:** 1.0

Complete step-by-step guide for deploying Pawsitive Placements to a live web server.

---

## 📋 Pre-Deployment Checklist

Before deploying, ensure:

- [ ] All features tested locally
- [ ] Test suite passes: `php tests/run_tests.php`
- [ ] No hardcoded localhost URLs
- [ ] `.env` file is NOT in version control (check `.gitignore`)
- [ ] Database schema is ready (`database/schema.sql`)
- [ ] All sensitive data uses environment variables
- [ ] Default admin password changed (if using seed data)

---

## 🌐 Step-by-Step Deployment

### Step 1: Choose Your Hosting Provider

**Recommended Options:**

1. **Shared Hosting (cPanel)** - Best for beginners
   - Examples: Bluehost, HostGator, SiteGround
   - Includes: cPanel, phpMyAdmin, FTP access
   - Cost: $3-10/month

2. **VPS/Cloud Hosting** - More control
   - Examples: DigitalOcean, Linode, AWS, Azure
   - Requires: Basic server management knowledge
   - Cost: $5-20/month

3. **Managed PHP Hosting**
   - Examples: Heroku, Railway, Fly.io
   - Easiest deployment, but may require adjustments
   - Cost: Free tier to $10+/month

**Requirements:**
- PHP 7.4 or higher
- MySQL/MariaDB 5.7 or higher
- Apache or Nginx web server
- mod_rewrite enabled (for clean URLs)
- At least 100MB storage space

---

### Step 2: Prepare Your Files

#### Option A: ZIP Upload (Recommended for cPanel)

1. **Create a ZIP file** of your project:
   ```bash
   # On Windows (PowerShell)
   Compress-Archive -Path * -DestinationPath PawsitivePlacements.zip -Exclude .env
   
   # Or manually:
   # - Select all files/folders EXCEPT .env
   # - Right-click → Send to → Compressed (zipped) folder
   ```

2. **Files to EXCLUDE from ZIP:**
   - `.env` (create new on server)
   - `images/*.jpg`, `images/*.png` (user uploads - optional, can upload separately)
   - Any test files you don't need

3. **Files to INCLUDE:**
   - All PHP files
   - All directories (admins, api, application, contact, etc.)
   - `database/schema.sql`
   - `styles/`, `js/`, `images/` (folder structure)
   - `README.md`, `LICENSE`
   - `.gitignore` (if using Git)

#### Option B: Git Deployment (Advanced)

1. **Push to GitHub:**
   ```bash
   git init
   git add .
   git commit -m "Initial deployment"
   git remote add origin https://github.com/yourusername/PawsitivePlacements.git
   git push -u origin main
   ```

2. **On server (via SSH):**
   ```bash
   cd public_html
   git clone https://github.com/yourusername/PawsitivePlacements.git
   ```

---

### Step 3: Upload Files to Server

#### Method 1: cPanel File Manager

1. **Login to cPanel**
   - Access: `https://yourdomain.com/cpanel`
   - Login with credentials from hosting provider

2. **Navigate to File Manager**
   - Click "File Manager" icon
   - Go to `public_html` (or your domain folder)

3. **Upload ZIP File**
   - Click "Upload" button
   - Select your `PawsitivePlacements.zip` file
   - Wait for upload to complete

4. **Extract Files**
   - Right-click on `PawsitivePlacements.zip`
   - Select "Extract"
   - Choose extraction location (usually `public_html`)
   - Click "Extract File(s)"

5. **Verify Structure**
   - You should see folders: `admins/`, `api/`, `application/`, etc.
   - All files should be in `public_html/PawsitivePlacements/`

#### Method 2: FTP Upload (FileZilla)

1. **Download FileZilla**
   - https://filezilla-project.org/
   - Install and open

2. **Get FTP Credentials**
   - From hosting provider's control panel
   - Usually: hostname, username, password, port (21)

3. **Connect to Server**
   - Enter FTP credentials in FileZilla
   - Click "Quickconnect"
   - Navigate to `public_html` on server

4. **Upload Files**
   - Drag and drop all project files from local to server
   - Maintain folder structure
   - Wait for all files to upload

---

### Step 4: Create Database on Server

#### Using cPanel MySQL Databases

1. **Access MySQL Databases**
   - In cPanel, click "MySQL Databases"

2. **Create Database**
   - Enter database name: `pawsitive_placements` (or your choice)
   - Click "Create Database"
   - Note the full database name (usually `username_pawsitive_placements`)

3. **Create Database User**
   - Scroll to "MySQL Users" section
   - Enter username: `pawsitive_user` (or your choice)
   - Enter strong password (use password generator)
   - Click "Create User"
   - Note the full username (usually `username_pawsitive_user`)

4. **Add User to Database**
   - Scroll to "Add User to Database"
   - Select user and database from dropdowns
   - Click "Add"
   - Check "ALL PRIVILEGES"
   - Click "Make Changes"

5. **Save Credentials**
   - Write down:
     - Database name: `username_pawsitive_placements`
     - Database user: `username_pawsitive_user`
     - Database password: `your_password`
     - Database host: Usually `localhost` (check with hosting provider)

---

### Step 5: Import Database Schema

1. **Access phpMyAdmin**
   - In cPanel, click "phpMyAdmin"
   - Or go to: `https://yourdomain.com/phpmyadmin`

2. **Select Your Database**
   - Click on your database name in left sidebar
   - Should be empty (or have default tables)

3. **Import Schema**
   - Click "Import" tab at top
   - Click "Choose File" button
   - Select `database/schema.sql` from your uploaded files
   - Scroll down, click "Go" button
   - ✅ Wait for "Import has been successfully finished" message

4. **Verify Tables**
   - You should see tables: `users`, `pets`, `applications`, `administrators`, etc.
   - Check that seed data is present (admin and test user accounts)

---

### Step 6: Create .env File on Server

1. **Create .env File**
   - In cPanel File Manager, navigate to `public_html/PawsitivePlacements/`
   - Click "New File" button
   - Name it: `.env` (with the dot at the beginning)

2. **Add Configuration**
   - Right-click `.env` → "Edit"
   - Add the following content:
   ```env
   # Database Configuration
   DB_HOST=localhost
   DB_NAME=username_pawsitive_placements
   DB_USER=username_pawsitive_user
   DB_PASS=your_database_password
   DB_CHARSET=utf8mb4

   # Application Environment
   APP_ENV=production

   # Security (Optional - enable if you have SSL)
   # FORCE_HTTPS=true
   ```

3. **Replace with Your Values:**
   - `DB_NAME`: Your actual database name from Step 4
   - `DB_USER`: Your actual database username from Step 4
   - `DB_PASS`: Your actual database password from Step 4
   - `DB_HOST`: Usually `localhost` (check with hosting provider)

4. **Save File**
   - Click "Save Changes"

---

### Step 7: Set File Permissions

1. **Set Folder Permissions**
   - In File Manager, navigate to `images/` folder
   - Right-click → "Change Permissions"
   - Set to `755` (or `777` if 755 doesn't work)
   - Click "Change Permissions"

2. **Set .env File Permissions**
   - Right-click `.env` file
   - "Change Permissions"
   - Set to `644` (readable, not writable by public)
   - Click "Change Permissions"

**Permission Reference:**
- Folders: `755` (rwxr-xr-x)
- Files: `644` (rw-r--r--)
- Executable scripts: `755`
- Writable folders (images): `755` or `777` if needed

---

### Step 8: Configure Domain/URL

#### Option A: Install in Root Directory

If you want the site at `https://yourdomain.com`:

1. **Move Files to Root**
   - Move all files from `public_html/PawsitivePlacements/` to `public_html/`
   - Update `.env` file path if needed

#### Option B: Install in Subdirectory

If you want the site at `https://yourdomain.com/PawsitivePlacements`:

1. **Keep Current Structure**
   - Files stay in `public_html/PawsitivePlacements/`
   - Access at: `https://yourdomain.com/PawsitivePlacements`

2. **Update Base Path (if needed)**
   - Check `view/header.php` and `view/footer.php`
   - Ensure `$base_path` is set correctly

---

### Step 9: Test the Application

1. **Access Homepage**
   - Visit: `https://yourdomain.com` (or `https://yourdomain.com/PawsitivePlacements`)
   - Should see homepage without errors

2. **Test Database Connection**
   - Try to register a new account
   - If you see database errors, check `.env` credentials

3. **Test Login**
   - **Admin Login:**
     - Go to Admin Login page
     - Email: `admin@example.com`
     - Password: `password` (⚠️ Change this immediately!)
   - **User Login:**
     - Username: `janedoe`
     - Password: `password` (⚠️ Change this immediately!)

4. **Test Key Features:**
   - [ ] Browse pets
   - [ ] Search/filter pets
   - [ ] Submit adoption application
   - [ ] Submit pet for rehoming
   - [ ] Forum posts/comments
   - [ ] Contact form
   - [ ] Admin panel access

---

### Step 10: Security Hardening (IMPORTANT!)

1. **Change Default Passwords**
   - Login as admin
   - Change admin password immediately
   - Change test user passwords
   - Remove or secure test accounts

2. **Enable HTTPS/SSL**
   - Most hosting providers offer free SSL (Let's Encrypt)
   - In cPanel: "SSL/TLS Status" → Enable SSL
   - Update `.env` to include `FORCE_HTTPS=true` (if supported)

3. **Protect .env File**
   - Ensure `.env` has permissions `644`
   - Verify `.htaccess` blocks direct access (if using Apache)

4. **Update Error Reporting**
   - In production, disable error display
   - Check `util/session.php` and other files
   - Don't expose database credentials in errors

5. **Regular Backups**
   - Set up automatic database backups in cPanel
   - Backup files regularly
   - Store backups off-server

---

## 🔧 Troubleshooting Common Issues

### "Database connection failed"

**Solutions:**
- ✅ Check `.env` file exists and has correct credentials
- ✅ Verify database name, user, password match cPanel
- ✅ Check database host (may not be `localhost` - check with hosting provider)
- ✅ Verify database user has ALL PRIVILEGES
- ✅ Test connection in phpMyAdmin

### "404 Not Found" or "Page not found"

**Solutions:**
- ✅ Check files uploaded to correct directory
- ✅ Verify file paths are correct
- ✅ Check `.htaccess` file exists (if using URL rewriting)
- ✅ Verify Apache mod_rewrite is enabled
- ✅ Check file permissions (should be readable)

### "Permission denied" on images folder

**Solutions:**
- ✅ Set `images/` folder permissions to `755` or `777`
- ✅ Check folder ownership matches web server user
- ✅ Verify folder is writable by web server

### "CSRF token invalid"

**Solutions:**
- ✅ Check session is working (cookies enabled)
- ✅ Verify `util/session.php` is loaded
- ✅ Check PHP session directory is writable
- ✅ Clear browser cookies and try again

### Images not displaying

**Solutions:**
- ✅ Check image paths are correct (relative paths)
- ✅ Verify `images/` folder exists and is accessible
- ✅ Check file permissions on images
- ✅ Verify image URLs in database are correct
- ✅ Check for mixed content (HTTP/HTTPS) issues

### "Class not found" or "Function not found"

**Solutions:**
- ✅ Check all `require_once` paths are correct
- ✅ Verify all model files are uploaded
- ✅ Check file permissions (should be readable)
- ✅ Verify PHP version is 7.4 or higher

---

## 📞 Getting Help

### Check Error Logs

1. **cPanel Error Logs**
   - In cPanel: "Errors" section
   - View recent errors

2. **PHP Error Log**
   - Usually in: `public_html/error_log`
   - Or check cPanel "Error Log" section

3. **Apache Error Log**
   - In cPanel: "Metrics" → "Errors"
   - Or contact hosting support

### Contact Support

- **Hosting Provider:** For server/database issues
- **Application Issues:** Check `docs/DEPLOYMENT_GUIDE.md`
- **Database Issues:** Verify credentials and permissions

---

## ✅ Post-Deployment Checklist

After deployment, verify:

- [ ] Homepage loads without errors
- [ ] Database connection works
- [ ] User registration works
- [ ] Login works (user and admin)
- [ ] Pet listings display correctly
- [ ] Search/filter works
- [ ] Adoption applications submit
- [ ] Pet rehoming form works
- [ ] Forum posts/comments work
- [ ] Contact form works
- [ ] Admin panel accessible
- [ ] Images upload and display
- [ ] All forms submit successfully
- [ ] HTTPS/SSL enabled (if available)
- [ ] Default passwords changed
- [ ] Backups configured

---

## 🎉 Success!

Your application should now be live and accessible to users!

**Next Steps:**
1. Change all default passwords
2. Test all features thoroughly
3. Set up regular backups
4. Monitor error logs
5. Consider setting up analytics
6. Update DNS if using custom domain

---

## 📚 Additional Resources

- **Detailed Testing Guide:** `docs/DEPLOYMENT_GUIDE.md`
- **Project Structure:** `docs/PROJECT_STRUCTURE.md`
- **Quick Start:** `QUICK_START.md`
- **README:** `README.md`

---

**Need help?** Check the troubleshooting section above or review the error logs on your server.

