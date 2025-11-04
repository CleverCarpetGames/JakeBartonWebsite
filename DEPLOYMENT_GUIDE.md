# Hostinger Deployment Guide

## The Problem
You have files in `_public_html` locally, but Hostinger uses `public_html` as the root directory.

## Solution: Upload Files Correctly

### Step 1: What to Upload
You need to upload **the contents** of `_public_html`, NOT the folder itself.

Upload these files/folders to Hostinger's `public_html` directory:
```
public_html/               <- Hostinger's root
├── index.php             <- Upload this
├── assets/               <- Upload this folder
│   ├── css/
│   │   └── styles.css
│   └── js/
│       └── gallery.js
└── portfolio/            <- Upload this folder
    ├── index.php
    └── tshirt-designs/
        ├── index.php
        └── images/
```

### Step 2: File Manager Method (Easiest)

1. **Login to Hostinger** → Go to File Manager
2. **Navigate to** `public_html` folder
3. **Delete** any default files (index.html, etc.)
4. **Upload these items** from your `_public_html` folder:
   - `index.php`
   - `assets/` (entire folder)
   - `portfolio/` (entire folder)
   - Any other files except `test.php`, `readme.html`, `README.txt`

### Step 3: Via FTP (Alternative)

1. Connect to Hostinger via FTP
2. Navigate to `/public_html/`
3. Upload all contents from `_public_html/`

### Step 4: Verify Structure

After upload, your Hostinger file structure should look like:
```
/public_html/
├── index.php
├── assets/
│   ├── css/
│   │   └── styles.css
│   └── js/
│       └── gallery.js
└── portfolio/
    ├── index.php
    └── tshirt-designs/
        ├── index.php
        └── images/
            ├── thumbnails/
            └── full/
```

### Step 5: Test Your Site

Visit your domain:
- Homepage: `https://yourdomain.com/` or `https://yourdomain.com/index.php`
- Portfolio: `https://yourdomain.com/portfolio/`
- T-Shirts: `https://yourdomain.com/portfolio/tshirt-designs/`

## Common Issues & Fixes

### Issue 1: White background instead of black
**Cause:** CSS file not loading
**Fix:** Check that `assets/css/styles.css` exists in the right location

### Issue 2: Links don't work
**Cause:** Files uploaded to wrong directory
**Fix:** Make sure files are in `public_html`, not `public_html/_public_html`

### Issue 3: PHP not rendering
**Cause:** Accessing wrong file or PHP not enabled
**Fix:** Make sure you're accessing `.php` files, not `.html` files

## Quick Check Commands

If you have SSH access to Hostinger, run:
```bash
cd ~/public_html
ls -la
```

Should show:
- index.php
- assets/
- portfolio/

## Need Help?

If it's still not working, check:
1. Is the CSS file at: `public_html/assets/css/styles.css`?
2. Are you visiting the PHP file (index.php) not HTML?
3. Did you upload the folders themselves, not a parent folder?
