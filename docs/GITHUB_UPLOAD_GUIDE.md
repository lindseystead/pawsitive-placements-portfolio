# GitHub Upload Guide - Pawsitive Placements

**Author:** Lindsey D. Stead  
**Date:** November 2025  
**Purpose:** Step-by-step guide to upload your portfolio to GitHub while protecting proprietary code

---

## 🎯 Strategy

**Public GitHub Repo:** Showcase key files, README, screenshots, documentation  
**Private Full Code:** Keep complete codebase private or on live server only  
**Best of Both:** Recruiters see skills, code stays protected

---

## 📋 Pre-Upload Checklist

- [ ] `.gitignore` configured to exclude sensitive files
- [ ] `portfolio-samples/` folder created with key files
- [ ] `README.md` is professional and complete
- [ ] Screenshots added to `screenshots/` folder
- [ ] `LICENSE` file included
- [ ] Documentation files ready
- [ ] No `.env` files in project
- [ ] No database credentials exposed
- [ ] Test: `git status` shows only safe files

---

## 🚀 Step-by-Step Upload Process

### Step 1: Initialize Git Repository

```bash
# Navigate to your project directory
cd C:\xampp\htdocs\PawsitivePlacements

# Initialize git (if not already done)
git init

# Verify .gitignore is in place
git status
```

### Step 2: Verify Files to Include

```bash
# Check what will be committed (should NOT show sensitive files)
git status

# You should see:
# ✅ README.md
# ✅ LICENSE
# ✅ screenshots/
# ✅ docs/
# ✅ portfolio-samples/
# ✅ database/schema.sql
# ✅ robots.txt
# ✅ sitemap.php
# ✅ .htaccess
# ❌ Should NOT see: .env, model/database.php, admins/*.php, etc.
```

### Step 3: Stage Safe Files

```bash
# Add all safe files
git add README.md
git add LICENSE
git add screenshots/
git add docs/
git add portfolio-samples/
git add database/schema.sql
git add robots.txt
git add sitemap.php
git add .htaccess
git add .gitignore

# Verify what's staged
git status
```

### Step 4: Create Initial Commit

```bash
git commit -m "Initial commit: Pawsitive Placements portfolio

- Full-stack PHP/MySQL pet adoption platform
- 71 PHP files, 14,110+ lines of code
- MVC architecture with RESTful API
- Enterprise-level SEO implementation
- Production-ready, BC PIPA-compliant

Portfolio samples included. Full codebase available upon request."
```

### Step 5: Create GitHub Repository

1. Go to [GitHub.com](https://github.com)
2. Click **"New repository"** (or **"+"** → **"New repository"**)
3. Repository name: `PawsitivePlacements`
4. Description: `Full-stack PHP/MySQL pet adoption platform. Production-ready with MVC architecture, RESTful API, and enterprise SEO.`
5. Visibility: **Public** (or Private if you prefer)
6. **DO NOT** initialize with README (you already have one)
7. Click **"Create repository"**

### Step 6: Connect and Push

```bash
# Add remote repository (replace YOUR_USERNAME)
git remote add origin https://github.com/YOUR_USERNAME/PawsitivePlacements.git

# Rename branch to main (if needed)
git branch -M main

# Push to GitHub
git push -u origin main
```

### Step 7: Verify Upload

1. Visit your GitHub repository
2. Check that:
   - ✅ README displays correctly
   - ✅ Screenshots are visible
   - ✅ Portfolio samples are accessible
   - ✅ No sensitive files are visible
   - ✅ Documentation is included

---

## 🔒 What's Protected

### Files Excluded by .gitignore:

- ❌ `.env` files (environment variables)
- ❌ `model/database.php` (database credentials)
- ❌ `admins/*.php` (full admin panel)
- ❌ `model/*.php` (full models - samples only)
- ❌ `api/*.php` (full APIs - samples only)
- ❌ User-uploaded images
- ❌ Log files
- ❌ Backup files

### Files Included (Safe to Show):

- ✅ `README.md` (professional documentation)
- ✅ `LICENSE` (proprietary license)
- ✅ `screenshots/` (all screenshots)
- ✅ `docs/` (documentation)
- ✅ `portfolio-samples/` (code samples)
- ✅ `database/schema.sql` (database structure)
- ✅ `robots.txt`, `sitemap.php`, `.htaccess` (config examples)

---

## 📁 Portfolio Samples Included

The `portfolio-samples/` folder contains:

1. **`util/seo.php`** - SEO implementation (356 lines)
2. **`util/csrf.php`** - Security implementation
3. **`api/newsletter.php`** - RESTful API example
4. **`pets/pet_detail.php`** - Frontend with SEO integration
5. **`view/header.php`** - Shared component
6. **`model/users_db_sample.php`** - Database model example (partial)

These demonstrate:
- ✅ PDO prepared statements
- ✅ Security best practices
- ✅ SEO optimization
- ✅ API development
- ✅ MVC architecture
- ✅ Code organization

---

## 🌐 Live Deployment Strategy

**Recommended Approach:**

1. **GitHub (Public):** Portfolio samples + README + screenshots
2. **Live Server (www.pawsitiveplacements.ca):** Full codebase deployed
3. **Private Backup:** Full codebase in private repo or local only

**Benefits:**
- Recruiters see your skills on GitHub
- Live site demonstrates full functionality
- Code remains proprietary
- Best of both worlds!

---

## 📧 For Recruiters Requesting Full Code

**Response Template:**

> "Thank you for your interest in Pawsitive Placements! The full codebase (71 PHP files, 14,110+ lines) is proprietary, but I'm happy to provide access for technical evaluation. 
> 
> Please contact **info@lifesavertech.ca** with:
> - Your name and company
> - Purpose of code review
> - Timeline for review
> 
> I can also provide a code walkthrough during an interview. The live site is available at **www.pawsitiveplacements.ca** for functional demonstration."

---

## 🔄 Updating Your Repository

When you make changes:

```bash
# Check status
git status

# Add changed files (only safe ones)
git add README.md
git add portfolio-samples/
# etc.

# Commit
git commit -m "Update: [description of changes]"

# Push
git push origin main
```

---

## ✅ Final Verification

Before sharing your GitHub link:

- [ ] Visit your repository URL
- [ ] README displays correctly with screenshots
- [ ] Portfolio samples are accessible
- [ ] No sensitive information visible
- [ ] Live demo link works (www.pawsitiveplacements.ca)
- [ ] License file is present
- [ ] Documentation is complete

---

## 🎯 GitHub Repository Settings

**Recommended Settings:**

1. **Description:** "Full-stack PHP/MySQL pet adoption platform | Production-ready | BC PIPA-compliant"
2. **Topics:** `php`, `mysql`, `bootstrap`, `full-stack`, `mvc`, `restful-api`, `seo`, `pet-adoption`
3. **Website:** `https://www.pawsitiveplacements.ca`
4. **Pin Repository:** Pin to your profile for visibility

---

## 📊 What Recruiters Will See

### ✅ Visible on GitHub:
- Professional README with live demo link
- 4 high-quality screenshots
- Database schema (shows design skills)
- SEO implementation code
- Security implementation code
- API endpoint example
- Frontend integration example
- Comprehensive documentation
- Project structure

### 🔒 Protected (Not Visible):
- Full admin panel code
- Complete model implementations
- Database credentials
- Production configurations
- User data

---

**Your GitHub portfolio is now ready to showcase your full-stack development skills while protecting your proprietary codebase!**

