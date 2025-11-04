# 🎯 STEP-BY-STEP HOSTINGER UPLOAD GUIDE

## ⚠️ THE KEY ISSUE
You're uploading to the WRONG location. Here's what's happening:

### ❌ WRONG:
```
public_html/
└── _public_html/          <- Extra folder (WRONG!)
    ├── index.php
    ├── assets/
    └── portfolio/
```

### ✅ CORRECT:
```
public_html/               <- Root folder
├── index.php             <- Directly here!
├── assets/
└── portfolio/
```

---

## 📋 UPLOAD INSTRUCTIONS

### Step 1: Login to Hostinger
1. Go to Hostinger control panel
2. Click **File Manager**
3. Navigate to `public_html` folder

### Step 2: Clean the Directory
**IMPORTANT:** Delete everything currently in `public_html`:
- index.html
- Any _public_html folder
- Any other files

Your `public_html` should be **EMPTY**

### Step 3: Upload Files
On your computer, go to:
```
/Users/jakebarton/Documents/GitHub/JakeBartonWebsite/hostinger_upload/
```

You'll see:
- index.php
- assets/ (folder)
- portfolio/ (folder)

**Upload these 3 items** directly to Hostinger's `public_html` folder.

### Step 4: Verify Structure
In Hostinger File Manager, your `public_html` should now look like:

```
public_html/
├── index.php                    <- Main homepage
├── assets/                      <- Styles and scripts
│   ├── css/
│   │   └── styles.css          <- Black background styling
│   └── js/
│       └── gallery.js          <- Gallery functionality
└── portfolio/                   <- Portfolio section
    ├── index.php               <- Portfolio landing
    └── tshirt-designs/
        ├── index.php           <- T-shirt gallery
        └── images/
            ├── full/           <- Full size images
            └── thumbnails/     <- Thumbnail images
```

---

## 🔍 HOW TO CHECK IF IT WORKED

### Test 1: Check Files
In Hostinger File Manager:
- Click on `public_html`
- You should see `index.php` at the ROOT level
- You should see `assets` folder at the ROOT level
- You should see `portfolio` folder at the ROOT level

### Test 2: View CSS File
In File Manager:
- Navigate to: `public_html/assets/css/styles.css`
- Right-click → Edit
- First few lines should show:
```css
/* CSS Variables */
:root {
    --primary-black: #000000;
    --secondary-black: #1a1a1a;
```

### Test 3: Visit Your Site
Open your browser and go to your domain:
- `https://yourdomain.com`

You should see:
- ✅ Black background
- ✅ "JAKE BARTON" in large white text
- ✅ White borders and text
- ✅ Animated parallax background

---

## 🐛 TROUBLESHOOTING

### Problem: Still white background
**Solution:** CSS file is not loading. Check:
1. Is `styles.css` at `public_html/assets/css/styles.css`?
2. Clear your browser cache (Ctrl+Shift+R or Cmd+Shift+R)

### Problem: Links don't work
**Solution:** Files are in wrong location. Make sure:
1. NO nested `_public_html` folder
2. Files are directly in `public_html`

### Problem: Page shows PHP code instead of rendering
**Solution:** 
1. Make sure you're accessing `.php` files not `.html`
2. PHP should be enabled by default on Hostinger

---

## 📞 NEED MORE HELP?

If you're still having issues, tell me:
1. What do you see when you visit your domain?
2. What files/folders do you see when you click on `public_html` in File Manager?
3. Take a screenshot of your File Manager showing the public_html contents

---

## ✨ QUICK CHECKLIST

Before you say "done", verify:
- [ ] Logged into Hostinger File Manager
- [ ] Navigated to `public_html` folder
- [ ] Deleted any old files in public_html
- [ ] Uploaded `index.php` to public_html root
- [ ] Uploaded `assets` folder to public_html root
- [ ] Uploaded `portfolio` folder to public_html root
- [ ] Visited your domain and see black background
- [ ] Can click on Portfolio and see it work
- [ ] Can click on T-Shirt Designs and see the gallery

All checked? You're done! 🎉
