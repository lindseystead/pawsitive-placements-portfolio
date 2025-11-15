# GitHub Portfolio Strategy - Pawsitive Placements

**Author:** Lindsey D. Stead  
**Date:** November 2025  
**Purpose:** Guide for uploading to GitHub as a portfolio project while maintaining proprietary code protection

---

## 🎯 Strategy Overview

**Goal:** Showcase technical skills without exposing full proprietary codebase.

**Approach:** Create a "portfolio-samples" folder with key files that demonstrate skills, while keeping the full codebase private or selectively hidden.

---

## 📁 What to Include on GitHub

### ✅ **Always Include (Public):**

1. **README.md** - Professional recruiter-friendly README
2. **LICENSE** - Proprietary license file
3. **screenshots/** - All screenshots folder
4. **docs/** - Documentation (SEO strategy, deployment guides, etc.)
5. **database/schema.sql** - Database structure (shows design skills)
6. **robots.txt** - SEO configuration
7. **sitemap.php** - Shows SEO implementation
8. **.htaccess** - Shows server configuration skills
9. **Project structure files** - Shows organization

### ✅ **Include as Samples (Portfolio Showcase):**

Create a `portfolio-samples/` folder with:

1. **util/seo.php** - SEO implementation (shows advanced PHP skills)
2. **util/csrf.php** - Security implementation (shows security knowledge)
3. **api/newsletter.php** - API endpoint example (shows RESTful API skills)
4. **pets/pet_detail.php** - Frontend with SEO integration (shows full-stack skills)
5. **model/users_db.php** (partial) - Database model example (shows PDO skills)
6. **view/header.php** - Shared component (shows code organization)
7. **styles/main.css** (partial) - CSS organization (shows frontend skills)

### ❌ **Never Include (Keep Private):**

1. **.env files** - Environment variables
2. **model/database.php** - Database credentials
3. **Full admin panel** - Keep proprietary
4. **Full model implementations** - Show samples only
5. **Full API implementations** - Show 1-2 examples
6. **User-uploaded images** - Privacy concerns
7. **Production configs** - Security risk

---

## 📂 Recommended GitHub Structure

```
PawsitivePlacements/
├── README.md                    # ✅ Public - Professional README
├── LICENSE                      # ✅ Public - Proprietary license
├── .gitignore                   # ✅ Public - Shows what's excluded
├── screenshots/                 # ✅ Public - All screenshots
│   ├── homepage.png
│   ├── availablepets.png
│   ├── samplepet.png
│   └── communityforum.png
│
├── docs/                        # ✅ Public - Documentation
│   ├── SEO_STRATEGY.md
│   ├── DEPLOYMENT_GUIDE.md
│   ├── PROJECT_STRUCTURE.md
│   └── GITHUB_PORTFOLIO_STRATEGY.md
│
├── portfolio-samples/           # ✅ Public - Code samples
│   ├── util/
│   │   ├── seo.php             # SEO implementation
│   │   └── csrf.php            # Security implementation
│   ├── api/
│   │   └── newsletter.php      # API endpoint example
│   ├── model/
│   │   └── users_db_sample.php # Database model example (partial)
│   ├── pets/
│   │   └── pet_detail.php     # Frontend with SEO
│   └── view/
│       └── header.php          # Shared component
│
├── database/
│   └── schema.sql              # ✅ Public - Database design
│
├── robots.txt                   # ✅ Public - SEO config
├── sitemap.php                  # ✅ Public - SEO implementation
├── .htaccess                    # ✅ Public - Server config
│
└── [Other files hidden by .gitignore]
```

---

## 🔧 Step-by-Step GitHub Upload Process

### Step 1: Prepare Your Repository

```bash
# 1. Initialize git (if not already done)
git init

# 2. Create portfolio-samples folder
mkdir portfolio-samples
mkdir portfolio-samples/util
mkdir portfolio-samples/api
mkdir portfolio-samples/model
mkdir portfolio-samples/pets
mkdir portfolio-samples/view
```

### Step 2: Copy Sample Files

Copy these files to `portfolio-samples/`:
- `util/seo.php` → `portfolio-samples/util/seo.php`
- `util/csrf.php` → `portfolio-samples/util/csrf.php`
- `api/newsletter.php` → `portfolio-samples/api/newsletter.php`
- `pets/pet_detail.php` → `portfolio-samples/pets/pet_detail.php`
- `view/header.php` → `portfolio-samples/view/header.php`

### Step 3: Create Partial Model Sample

Create `portfolio-samples/model/users_db_sample.php` with:
- Function signatures
- Key functions (add_user, get_user_by_username_password)
- Comments showing PDO usage
- Remove sensitive business logic

### Step 4: Verify .gitignore

Ensure `.gitignore` excludes:
- All `model/*.php` (except samples)
- All `api/*.php` (except samples)
- All `admins/*.php`
- `.env` files
- `database.php` with credentials

### Step 5: Commit and Push

```bash
# Add files
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

# Commit
git commit -m "Initial portfolio commit - Pawsitive Placements"

# Create GitHub repository, then:
git remote add origin https://github.com/yourusername/PawsitivePlacements.git
git branch -M main
git push -u origin main
```

---

## 📝 What Recruiters Will See

### ✅ **Visible on GitHub:**
- Professional README with screenshots
- Database schema (shows design skills)
- SEO implementation (util/seo.php)
- Security implementation (util/csrf.php)
- API endpoint example (api/newsletter.php)
- Frontend integration (pets/pet_detail.php)
- Documentation and strategy
- Project structure

### 🔒 **Hidden (Protected):**
- Full admin panel code
- Complete model implementations
- Database credentials
- Production configurations
- User data and uploads

---

## 💡 Alternative: Private Repo with Public README

**Option:** Keep repository private, make README public via GitHub Pages or separate public repo.

**Benefits:**
- Full code protection
- Still showcase via README
- Share access with recruiters on request

**How:**
1. Create private repository with full code
2. Create public repository with just README + screenshots
3. Link to live site: www.pawsitiveplacements.ca

---

## 🚀 Live Deployment Strategy

Since you're deploying to www.pawsitiveplacements.ca:

1. **Keep GitHub repo private** OR use portfolio-samples approach
2. **Deploy full code to live server** (not on GitHub)
3. **GitHub shows:** Portfolio samples + README + screenshots
4. **Live site shows:** Full functionality

This way:
- Recruiters see your skills on GitHub
- Live site demonstrates full capabilities
- Code remains proprietary
- Best of both worlds!

---

## 📧 For Recruiters Requesting Full Code

**Response Template:**

> "Thank you for your interest! The full codebase is proprietary, but I'm happy to provide access for technical evaluation. Please contact info@lifesavertech.ca to request repository access. I can also provide a code walkthrough during an interview."

---

## ✅ Checklist Before Pushing to GitHub

- [ ] `.gitignore` properly configured
- [ ] No `.env` files in repo
- [ ] No database credentials exposed
- [ ] Portfolio samples folder created
- [ ] README.md is professional and complete
- [ ] Screenshots added
- [ ] LICENSE file included
- [ ] Documentation files included
- [ ] Test that sensitive files are excluded: `git status`

---

**This strategy allows you to showcase your skills while protecting your proprietary codebase!**

